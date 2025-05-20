<?php

namespace App\Http\Controllers;

use App\Models\Profit;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view profit',['only'=> ['index','show']]);
    //    $this->middleware('permission:create profit',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit profit',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete profit',['only'=> ['destroy']]);

    // }


public function index()
{
    // Check if the user is logged in
    if (!Auth::check()) {
        return redirect()->route('login'); // Redirect to login if not authenticated
    }

    // Get the logged-in user's ID
    $userId = Auth::user()->id;

    // Fetch the logged-in user's profile data
    $profileData = User::find($userId);

    // Filter profits with their related quotations for the logged-in user
    $profit = Profit::with('quotation')
        ->whereHas('quotation', function ($query) use ($userId) {
            $query->where('user_id', $userId); // Filter quotations by user_id
        })
        ->get();

    // Fetch all quotations created by the logged-in user
    $quotation = Quotation::where('user_id', $userId)->get();

    // Calculate totals specific to the logged-in user's quotations
    $totalGrandTotal = $quotation->sum('grand_total');
    $salesGrandTotal = $quotation->where('status', 'approved')->sum('grand_total');

    return view('profit.index', compact('profileData', 'profit', 'quotation', 'totalGrandTotal', 'salesGrandTotal'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);

        // Fetch IDs of quotations already associated with profits
        $usedQuotationIds = Profit::pluck('quotation_id')->toArray();

        // Fetch only quotations that are not associated with any profit
        $quotation = Quotation::whereNotIn('id', $usedQuotationIds)->where('user_id', $id)->get();

        return view('profit.create', compact('profileData', 'quotation'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'note' => 'nullable|string|max:255',
            'quotation_id' => 'required|integer|exists:quotations,id',
        ]);

        // Generate a unique slug
        $slug = Str::slug($request->input('balance') . '-' . uniqid());

        // Create the profit record
        Profit::create([
            'amount_paid' => $request->input('amount_paid'),
            'date' => $request->input('date'),
            'amount_spent' => $request->input('amount_spent'),
            'note' => $request->input('note'),
            'quotation_id' => $request->input('quotation_id'),
            'slug' => $slug,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('profit.index')->with('success', 'Profit created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profit $profit)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('profit.show', compact('profileData', 'profit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profit $profit)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $quotation = Quotation::all();
        $profileData = User::find($id);
        return view('profit.edit', compact('profileData', 'profit','quotation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profit $profit)
    {


        $profit->update([
            'amount_paid' => $request->input('amount_paid'),
            'date' => $request->input('date'),
            'amount_spent' => $request->input('amount_spent'),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('profit.index')->with('success', 'Profit updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profit $profit)
    {
        $profit->delete();

        return redirect()->route('profit.index')->with('success', 'Profit deleted successfully!');
    }
}
