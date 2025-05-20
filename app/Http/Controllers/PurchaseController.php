<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $purchases = Purchase::with(['user', 'ticket', 'event'])->get();
        $tickets = Ticket::all();
        $events = Event::all();

        // Detect if the user is on a mobile device
        $agent = new Agent();
        if ($agent->isMobile()) {
            // Load a separate view for mobile devices
            return view('purchase.mobile_index', compact('purchases', 'tickets', 'events'));
        }

        // Load the standard view for non-mobile devices
        return view('purchase.index', compact('purchases', 'tickets', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        return view('purchase.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'transaction_number' => 'required|string',
        ]);

        $event = Event::findOrFail($request->input('event_id'));
        $ticket = Ticket::where('event_id', $event->id)
                        ->where('type', $request->input('ticket_type'))
                        ->first();

        if (!$ticket) {
            return redirect()->back()->with('error', 'Selected ticket type is not available.');
        }

        if ($ticket->quantity < $request->input('quantity')) {
            return redirect()->back()->with('error', 'Not enough tickets available.');
        }

        // Deduct the ticket quantity
        $ticket->quantity -= $request->input('quantity');
        $ticket->save();

        // Generate a unique slug
        $baseSlug = $event->slug ?: Str::slug($event->name);
        $slug = $baseSlug;
        $counter = 1;

        while (Purchase::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Save the purchase
        Purchase::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'ticket_id' => $ticket->id,
            'quantity' => $request->input('quantity'),
            'status' => 'completed',
            'transaction_number' => $request->input('transaction_number'),
            'slug' => $slug,
        ]);

        return redirect()->route('purchases.index')->with('success', 'Purchase completed successfully!');
    }

    /**
     * Display the specified resource.
     */

     public function show(Purchase $purchase)
     {
         // Generate QR Code dynamically for the purchase slug
         $qrCode = QrCode::size(200)->generate($purchase->slug);

         // Pass the QR Code and purchase details to the view
         return view('purchase.show', compact('purchase', 'qrCode'));
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $events = Event::all();
        return view('purchase.edit', compact('purchase', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        // Validate the request
        // $request->validate([
        //     'ticket_type' => 'required',
        //     'quantity' => 'required|integer|min:1',
        //     'status' => 'required|in:active,unactive',
        // ]);

        // Find the ticket based on the type
        $ticket = Ticket::where('type', $request->input('ticket_type'))->first();

        if (!$ticket) {
            return back()->with('error', 'Invalid ticket type selected.');
        }

        // Update the purchase
        $purchase->update([
            'event_id' => $ticket->event_id, // Derive event_id from the ticket
            'ticket_id' => $ticket->id,      // Update ticket reference
            'quantity' => $request->input('quantity'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('purchase.index')->with('success', 'Purchase updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchase.index')->with('success', 'Purchase deleted successfully.');
    }

    /**
     * Export purchase details to PDF.
     */







     public function exportToPDF($slug)
     {
         $purchase = Purchase::where('slug', $slug)->firstOrFail();

         // Logo absolute path
         $logoPath = public_path('assets/images/logo-dark.png');
         $posterPath = public_path('events/' . $purchase->event->image);

         // Load the PDF view
         $pdf = Pdf::loadView('pdf.purchase', [
             'purchase' => $purchase,
             'logoPath' => $logoPath,
             'posterPath' => $posterPath,
         ])->setPaper([0, 0, 600, 300]); // Custom ticket size

         return $pdf->download($purchase->event->name . '_ticket.pdf');
     }









    /**
     * Handle ticket purchases.
     */
    public function purchase(Request $request, Event $event)
    {
        $request->validate([
            'ticket_type' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::where('event_id', $event->id)
                        ->where('type', $request->input('ticket_type'))
                        ->first();

        if (!$ticket) {
            return redirect()->back()->with('error', 'Ticket type not found for this event.');
        }

        if ($ticket->quantity < $request->input('quantity')) {
            return redirect()->back()->with('error', 'Not enough tickets available.');
        }

        // Deduct ticket quantity and save
        $ticket->quantity -= $request->input('quantity');
        $ticket->save();

        // Generate a unique slug
        $baseSlug = $event->slug ?: Str::slug($event->name);
        $slug = $baseSlug;
        $counter = 1;

        while (Purchase::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Log the purchase
        Purchase::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'ticket_id' => $ticket->id,
            'quantity' => $request->input('quantity'),
            'status' => 'completed',
            'transaction_number' => Str::uuid(),
            'slug' => $slug,
        ]);

        return redirect()->route('purchases.index')->with('success', 'Tickets purchased successfully!');
    }
}
