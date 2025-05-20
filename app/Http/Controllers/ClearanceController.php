<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Models\Garnish;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clearances = Clearance::with('garnish')->get();
        return view('clearances.index', compact('clearances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $garnishes = Garnish::all();

        // Fetch documents that are not assigned in the 'assigns' table
        $garnishes = Garnish::whereDoesntHave('clearance')->get();
        return view('clearances.create', compact('garnishes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'nullable|string|max:255',
            'bank_address' => 'nullable|string|max:255',
            'director' => 'nullable|string|max:255',
            'prepared_by' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            // 'user_id' => 'required|exists:users,id',
            'garnish_id' => 'required|exists:garnishes,id',
        ]);

        Clearance::create([
            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'director' => $request->director,
            'prepared_by' => $request->prepared_by,
            'position' => $request->position,
            'slug' => Str::slug($request->bank_name . '-' . Str::random(6)),
            'user_id' => Auth::id(),
            'garnish_id' => $request->garnish_id,
        ]);

        return redirect()->route('clearances.index')->with('success', 'Clearance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clearance $clearance)
    {
        return view('clearances.show', compact('clearance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clearance $clearance)
    {
        $garnishes = Garnish::all();
        return view('clearances.edit', compact('clearance','garnishes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clearance $clearance)
    {
        $request->validate([
            'bank_name' => 'nullable|string|max:255',
            'bank_address' => 'nullable|string|max:255',
            'director' => 'nullable|string|max:255',
            'prepared_by' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            // 'user_id' => 'required|exists:users,id',
            'garnish_id' => 'required|exists:garnishes,id',
        ]);

        $clearance->update([
            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'director' => $request->director,
            'prepared_by' => $request->prepared_by,
            'position' => $request->position,
            'slug' => Str::slug($request->bank_name . '-' . Str::random(6)),
            'user_id' => Auth::id(),
            'garnish_id' => $request->garnish_id,
        ]);

        return redirect()->route('clearances.index')->with('success', 'Clearance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clearance $clearance)
    {
        $clearance->delete();
        return redirect()->route('clearances.index')->with('success', 'Clearance deleted successfully.');
    }


    public function exportToPDF($slug)
    {
        // Fetch the letter
        $clearance = Clearance::where('slug', $slug)->firstOrFail();

        // Fetch the associated document using document_id
        $garnish = Garnish::findOrFail($clearance->garnish_id);

        // Pass both $letter and $document to the view
        $pdf = Pdf::loadView('pdf.clearance', compact('clearance', 'garnish'))
            ->setPaper('a4')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        return $pdf->download($clearance->bank_name . '.pdf');
    }
}
