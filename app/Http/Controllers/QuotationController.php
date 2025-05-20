<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Account;
use App\Models\Quotation;
use App\Models\Client;
use App\Models\QuotationItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Mail\QuotationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\User;

class QuotationController extends Controller
{
    //     public function __construct()
    // {
    //    $this->middleware('permission:view quotation',['only'=> ['index','show']]);
    //    $this->middleware('permission:create quotation',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit quotation',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete quotation',['only'=> ['destroy']]);

    // }

    public function index()

    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $user = Auth::user(); // Get the logged-in user

        // Fetch quotations created by the logged-in user
   $quotations = Quotation::where('user_id', Auth::id())->latest()->get();
        // Calculate totals
        $totalGrandTotal = Quotation::where('user_id', $user->id)->sum('grand_total');
        $salesGrandTotal = Quotation::where('user_id', $user->id)
            ->where('status', 'approved')
            ->sum('grand_total');

        return view('quotations.index', compact('quotations', 'totalGrandTotal', 'salesGrandTotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user(); // Get the logged-in user
        $detail = Detail::where('user_id', $user->id)->latest()->get();
        $account = Account::where('user_id', $user->id)->latest()->get();
        $clients = Client::where('user_id', $user->id)->latest()->get();
        return view('quotations.create', compact('detail','account','clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
     // Store quotation datause Illuminate\Support\Str;



     public function store(Request $request)
     {
         // Validate the request
         $request->validate([
            //  'client_name' => 'required|string|max:255',
            //  'client_address' => 'required|string|max:255',
            //  'email' => 'required|email',
            //  'client_tpin' => 'required|string|max:255',
             'quotation_note' => 'required|string',
             'products' => 'required|array',
             'products.*.product_name' => 'required|string|max:255',
             'products.*.quantity' => 'required|integer|min:1',
             'products.*.price' => 'required|numeric|min:0',
             'products.*.total' => 'required|numeric|min:0',
             'tax_name' => 'nullable|string|max:255',
             'tax_percentage' => 'nullable|numeric|min:0',
             'grand_total' => 'required|numeric|min:0',
             'detail_id' => 'required|exists:details,id',
         ]);

         // Get the authenticated user
         $user = auth()->user();

         if (!$user) {
             return redirect()->back()->with('error', 'User must be logged in to create a quotation.');
         }

         // Generate a unique slug
         $clientName = $request->client_name ?? 'default-client-name';
         $slug = Str::slug($clientName, '-');
         $originalSlug = $slug;

         $counter = 1;
         while (Quotation::where('slug', $slug)->exists()) {
             $slug = "{$originalSlug}-{$counter}";
             $counter++;
         }

         // Save quotation with user ID and detail ID
         $quotation = Quotation::create([
             'type' => $request->type,
             'delivery_status' => $request->delivery_status,
             'status' => $request->status,
             'quotation_note' => $request->quotation_note,
             'tax_name' => $request->tax_name,
             'tax_percentage' => $request->tax_percentage,
             'tax_amount' => ($request->tax_percentage / 100) * $request->grand_total,
             'grand_total' => $request->grand_total,
             'slug' => $slug,
             'user_id' => $user->id,
             'detail_id' => $request->detail_id,
             'account_id' => $request->account_id,
             'client_id' => $request->client_id,
         ]);

         // Save quotation items (products)
         foreach ($request->products as $product) {
             $quotation->items()->create([
                 'product_name' => $product['product_name'],
                 'quantity' => $product['quantity'],
                 'price' => $product['price'],
                 'total' => $product['total'],
             ]);
         }



// // After creating quotation and items
// $quotation = Quotation::with(['client', 'detail', 'items'])->find($quotation->id);

// // Generate PDF from view
// $pdf = Pdf::loadView('pdf.quotation', compact('quotation'));

// // Send email to client
// Mail::to($quotation->client->email)->send(new QuotationMail($quotation, $pdf));



         return redirect()->route('quotations.index')->with('success', 'Quotation created successfully!');
     }


     public function sendEmail($slug)
{
    $quotation = Quotation::with(['client', 'detail', 'items'])->where('slug', $slug)->firstOrFail();

    // Generate the PDF
    $pdf = Pdf::loadView('pdf.quotation', compact('quotation'));

    // Send the email
    Mail::to($quotation->client->email)->send(new QuotationMail($quotation, $pdf));

    return redirect()->back()->with('success', 'Quotation emailed successfully to client!');
}


     public function approve(Request $request, $slug)
     {
         $quotation = Quotation::findOrFail($slug);

         // Update the status to approved
         $quotation->status = 'approved';
         $quotation->save();

         return redirect()->route('quotations.index')->with('success', 'Quotation approved successfully!');
     }

     public function approveDelivery(Request $request)
     {
         $quotation = Quotation::findOrFail($request->quotation_id);
         $quotation->delivery_status = 'delivered';
         $quotation->save();

         return redirect()->back()->with('success', 'Delivery status approved successfully.');
     }



    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation)
    {
        // Return the show view and pass the quotation instance
        $quotations = QuotationItem::all();
        return view('quotations.show', compact('quotation','quotations'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        $user = Auth::user(); // Get the logged-in user
        // Fetch all available addresses for the dropdown
        $detail = Detail::where('user_id', $user->id)->latest()->get();
        $account = Account::where('user_id', $user->id)->latest()->get();
        $client = Client::where('user_id', $user->id)->latest()->get();
        // Pass both the quotation and the details to the view
        return view('quotations.edit', compact('quotation', 'detail','account','client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
{
    // Validate the request
    $request->validate([

        'quotation_note' => 'required|string',
        'detail_id' => 'required|exists:details,id', // Ensure the detail_id exists in the details table
        'products' => 'required|array',
        'products.*.product_name' => 'required|string|max:255',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.price' => 'required|numeric|min:0',
        'products.*.total' => 'required|numeric|min:0',
        'tax_name' => 'nullable|string|max:255',
        'tax_percentage' => 'nullable|numeric|min:0',
        'grand_total' => 'required|numeric|min:0',
    ]);

    // Update the quotation
    $quotation->update([

        'type' => $request->type,
        'status' => $request->status,
        'delivery_status' => $request->delivery_status,
        'quotation_note' => $request->quotation_note,
        'detail_id' => $request->detail_id, // Update detail_id
        'account_id' => $request->account_id, // Update detail_id
        'tax_name' => $request->tax_name,
        'tax_percentage' => $request->tax_percentage,
        'tax_amount' => ($request->tax_percentage / 100) * $request->grand_total,
        'grand_total' => $request->grand_total,
    ]);

    // Update or recreate quotation items
    $quotation->items()->delete(); // Delete existing items
    foreach ($request->products as $product) {
        $quotation->items()->create([
            'product_name' => $product['product_name'],
            'quantity' => $product['quantity'],
            'price' => $product['price'],
            'total' => $product['total'],
        ]);
    }

    // Redirect with success message
    return redirect()->route('quotations.index')->with('success', 'Quotation updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
          // Delete the quotation and associated items
    $quotation->items()->delete(); // Delete associated items first
    $quotation->delete(); // Then delete the quotation

    // Redirect with success message
    return redirect()->route('quotations.index')->with('success', 'Quotation deleted successfully!');

    }


    public function exportToPDF($slug)
    {
        $quotation = Quotation::with('detail','account','client','profit')->where('slug', $slug)->firstOrFail();
        $pdf = Pdf::loadView('pdf.quotation', compact('quotation'));
        return $pdf->download($quotation->client->client_name . '.pdf');
    }


    public function invoice($slug)
    {


        $quotations = Quotation::with('detail','account','client','profit')->where('slug', $slug)->firstOrFail();
        $pdf = Pdf::loadView('pdf.invoice', compact('quotations'));
        return $pdf->download($quotations->client->client_name . '.pdf');
    }



    public function receipts($slug)
    {


        $receipts = Quotation::with('detail','account','client','profit')->where('slug', $slug)->firstOrFail();
        $pdf = Pdf::loadView('pdf.receipts', compact('receipts'));
        return $pdf->download($receipts->client->client_name . '.pdf');
    }

    public function delivery($slug)
    {

        $delivery = Quotation::with('detail','account','client')->where('slug', $slug)->firstOrFail();
        $pdf = Pdf::loadView('pdf.delivery_note', compact('delivery'));
        return $pdf->download($delivery->client->client_name . '.pdf');
    }

//     public function invoice($slug)
// {
//     $invoice = Quotation::with('detail')->where('slug', $slug)->firstOrFail(); // Correct variable name
//     $pdf = Pdf::loadView('pdf.invoice', compact('invoice')); // Pass the correct variable
//     return $pdf->download($invoice->client_name . '.pdf'); // Use the correct variable for filename
// }

// public function delivery($slug)
// {
//     $quotation = Quotation::with('detail')->where('slug', $slug)->firstOrFail(); // Correct variable name
//     $pdf = Pdf::loadView('pdf.delivery_note', compact('quotation')); // Pass the correct variable
//     return $pdf->download($quotation->client_name . '.pdf'); // Use the correct variable for filename
// }




    // public function invoice($slug)
    // {
    //     $quotation = Quotation::with('detail')->where('slug', $slug)->firstOrFail();
    //     $pdf = Pdf::loadView('pdf.invoice', compact('quotation'));
    //     return $pdf->download($quotation->client_name . '.pdf');
    // }

    // public function delivery($slug)
    // {
    //     $quotation = Quotation::with('detail')->where('slug', $slug)->firstOrFail();
    //     $pdf = Pdf::loadView('pdf.delivery_note', compact('quotation'));
    //     return $pdf->download($quotation->client_name . '.pdf');
    // }

}
