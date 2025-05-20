<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with('event')->get();
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the purchase of tickets.
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
             'user_id' => auth()->id(),
             'event_id' => $event->id,
             'ticket_id' => $ticket->id,
             'quantity' => $request->input('quantity'),
             'status' => $request->input('status'),
             'transaction_number' => $request->input('transaction_number'),
             'slug' => $slug, // Unique slug for the purchase
         ]);

         return redirect()->back()->with('success', 'Tickets purchased successfully!');
     }




}
