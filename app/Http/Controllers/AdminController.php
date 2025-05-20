<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Worker;
use App\Models\Quotation;
use App\Models\Setting;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\Program;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $user= User::find($id);
        // $visitors = Visitor::where('last_visit_at', '>=', now()->subMinutes(30))->get();
        $generalSettings = Setting::where('status', 'Published')->get();
        $displaySettings = Setting::where('status', 'Published')->get();
        $programs = Program::all();

            $today = Carbon::today();

    $workers = Worker::with(['attendances' => function($query) use ($today) {
        $query->whereDate('created_at', $today);
    }])->where('user_id', $id)->get();

        // Absent workers: those with NO attendance today
    $absentWorkers = $workers->filter(function ($worker) {
        return $worker->attendances->isEmpty();
    });

            // Fetch quotations created by the logged-in user
   $quotations = Quotation::where('user_id', Auth::id())->latest()->get();
        // Calculate totals
        $totalGrandTotal = Quotation::where('user_id', $user->id)->sum('grand_total');
        $salesGrandTotal = Quotation::where('user_id', $user->id)
            ->where('status', 'approved')
            ->sum('grand_total');




        return view ('dashboard.index', compact('user','generalSettings','displaySettings','programs','workers','absentWorkers','totalGrandTotal', 'salesGrandTotal'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the user

        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates the CSRF token

        return redirect('/login'); // Redirect to the login page
    }
}
