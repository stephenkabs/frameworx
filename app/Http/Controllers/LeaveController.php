<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Carbon\Carbon;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LeaveController extends Controller
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
            $workers = Worker::with('leaves')->get(); // Assuming Worker model has a relationship with Leave
            $leave = Leave::where('user_id', $user->id)->latest()->get();
            return view('leave.index', compact('workers','leave'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        return view('leave.create');
    }



public function store(Request $request)
{
    $user = auth()->user();
    $request->validate([
        'worker_id' => 'required|exists:workers,id',
        'type' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'description' => 'nullable|string',
    ]);

    // Fetch worker's leave records
    $worker = Worker::findOrFail($request->worker_id);
    $totalAnnualLeave = 24; // Fixed annual leave days

    // Calculate Used Leave Days
    $usedLeaveDays = $worker->leaves->where('type', 'Annual Leave')->sum(function ($leave) {
        return Carbon::parse($leave->start_date)->diffInDays(Carbon::parse($leave->end_date)) + 1;
    });

    // Calculate Requested Leave Days
    $requestedDays = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) + 1;

    // Calculate Remaining Leave Days
    $remainingLeaveDays = max($totalAnnualLeave - $usedLeaveDays, 0);

    // Prevent leave request if balance is insufficient
    if ($request->type === 'Annual Leave' && $requestedDays > $remainingLeaveDays) {
        return redirect()->back()->with('error', "Not enough leave balance! You have only $remainingLeaveDays days left.");
    }

    // Store leave request
    Leave::create([
        'worker_id' => $request->worker_id,
        'type' => $request->type,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'description' => $request->description,
        'user_id' => $user->id,
        'slug' => Str::slug($request->type . '-' . now()->timestamp), // Unique slug
    ]);

    return redirect()->route('leave.index')->with('success', 'Leave request created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        if ($leave->user_id !== Auth::id()) {
            abort(403);
        }

        return view('leave.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {


        return view('leave.edit', compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leave)
    {
        // if ($leave->user_id !== Auth::id()) {
        //     abort(403);
        // }

        $request->validate([
            'type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'worker_id' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $leave->update($request->only(['type', 'start_date', 'end_date', 'worker_id', 'description']));

        return redirect()->route('leave.index')->with('success', 'Leave request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {

        $leave->delete();

        return redirect()->route('leave.index')->with('success', 'Leave request deleted successfully!');
    }
}
