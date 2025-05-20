<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
        $user = Auth::user(); // Get the logged-in user
        $advances = Advance::with('worker')->where('user_id', $user->id)->latest()->get();
        return view('advance.index', compact('advances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $workers = Worker::all();
        return view('advance.create', compact('workers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'comment' => 'nullable|string',
        ]);

        $worker = Worker::findOrFail($request->worker_id);
        $baseSlug = Str::slug($worker->name);

        // Initialize slug variable
        $slug = $baseSlug;
        $counter = 1;

        // Check for duplicate slugs
        while (Advance::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Save the advance
        $advance = new Advance();
        $advance->worker_id = $request->worker_id;
        $advance->amount = $request->amount;
        $advance->date = $request->date;
        $advance->comment = $request->comment;
        $advance->slug = $slug;
        $advance->user_id = Auth::id();
        $advance->save();

        session()->flash('success', 'Advance created successfully!');
        return redirect()->route('advance.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advance $advance)
    {
        return view('advance.show', compact('advance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advance $advance)
    {
        $workers = Worker::all();
        return view('advance.edit', compact('advance', 'workers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advance $advance)
    {
        $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'comment' => 'nullable|string',
        ]);

        $worker = Worker::findOrFail($request->worker_id);
        $baseSlug = Str::slug($worker->name);

        // Initialize slug variable
        $slug = $baseSlug;
        $counter = 1;

        // Check for duplicate slugs, excluding current advance
        while (Advance::where('slug', $slug)->where('id', '!=', $advance->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Update the advance
        $advance->worker_id = $request->worker_id;
        $advance->amount = $request->amount;
        $advance->date = $request->date;
        $advance->comment = $request->comment;
        $advance->slug = $slug;
        $advance->save();

        session()->flash('success', 'Advance updated successfully!');
        return redirect()->route('advance.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advance $advance)
    {
        $advance->delete();
        session()->flash('success', 'Advance deleted successfully!');
        return redirect()->route('advance.index');
    }
}
