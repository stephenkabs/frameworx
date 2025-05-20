<?php

namespace App\Http\Controllers;

use App\Models\Waza;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WazaImport;
use Illuminate\Http\Request;

class WazaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wazas = Waza::latest()->get();
        return view('waza.index', compact('wazas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('waza.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'net_pay' => 'required|numeric',
            'accuedle_days' => 'required|numeric',
            'leave_days_taken' => 'required|numeric',
            'worked_days' => 'required|numeric',
            'term_date' => 'nullable|date',
            'comment' => 'nullable|string',
        ]);

        $user = auth()->user();

        $waza = new Waza();
        $waza->name = $request->name;
        $waza->position = $request->position;
        $waza->net_pay = $request->net_pay;
        $waza->accuedle_days = $request->accuedle_days;
        $waza->leave_days_taken = $request->leave_days_taken;
        $waza->worked_days = $request->worked_days;
        $waza->term_date = $request->term_date;
        $waza->comment = $request->comment;
        $waza->pay = $request->net_pay / $request->worked_days;
        $waza->user_id = $user->id;
        $waza->save();

        return redirect()->route('waza.index')->with('success', 'Record created successfully!');
    }

    public function importExcel(Request $request)
{
    $request->validate([
        'excel_file' => 'required|file|mimes:xlsx,xls'
    ]);

    Excel::import(new WazaImport, $request->file('excel_file'));

    return redirect()->back()->with('success', 'Wazas imported successfully!');
}

public function bulkDelete(Request $request)
{
    $ids = $request->ids;

    if ($ids) {
        Waza::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Selected records deleted.');
    }

    return redirect()->back()->with('error', 'No records selected.');
}


public function deleteAll()
{
    Waza::truncate(); // Deletes all rows without triggering model events

    return redirect()->back()->with('success', 'All records deleted successfully.');
}





    /**
     * Display the specified resource.
     */
    public function show(Waza $waza)
    {
        return view('waza.show', compact('waza'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Waza $waza)
    {
        return view('waza.edit', compact('waza'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Waza $waza)
    {
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'net_pay' => 'required|numeric',
            'accuedle_days' => 'required|numeric',
            'leave_days_taken' => 'required|numeric',
            'worked_days' => 'required|numeric',
            'term_date' => 'nullable|date',
            'comment' => 'nullable|string',
        ]);

        $waza->update([
            'name' => $request->name,
            'position' => $request->position,
            'net_pay' => $request->net_pay,
            'accuedle_days' => $request->accuedle_days,
            'leave_days_taken' => $request->leave_days_taken,
            'worked_days' => $request->worked_days,
            'term_date' => $request->term_date,
            'comment' => $request->comment,
        ]);

        return redirect()->route('waza.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Waza $waza)
    {
        $waza->delete();
        return redirect()->route('waza.index')->with('success', 'Record deleted successfully!');
    }
}
