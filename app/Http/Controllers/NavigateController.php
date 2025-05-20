<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use App\Exports\PayslipDaysExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Payslip;
use App\Models\Salary;
use App\Models\User;
use App\Models\Store;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Purchase;
use App\Models\Event;

class NavigateController extends Controller
{
    public function tickets()
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
            return view('my_tickets_mobile', compact('purchases', 'tickets', 'events'));
        }

        // Load the standard view for non-mobile devices
        return view('my_tickets', compact('purchases', 'tickets', 'events'));
    }


    public function reports()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $salary = Salary::where('user_id', Auth::id())->get(); // Fetch the results
        $payslip = Payslip::where('user_id', Auth::id())->get(); // Fetch the results

        return view('reports.advanced', compact('profileData', 'payslip', 'salary'));
    }


    public function days()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $salary = Salary::where('user_id', Auth::id())->get(); // Fetch the results
        $payslip = Payslip::where('user_id', Auth::id())->get(); // Fetch the results

        return view('reports.reported_days', compact('profileData', 'payslip', 'salary'));
    }


    public function apps()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $salary = Salary::where('user_id', Auth::id())->get(); // Fetch the results
        $payslip = Payslip::where('user_id', Auth::id())->get(); // Fetch the results
        $store = Store::all();

        return view('apps.menu', compact('profileData', 'payslip', 'salary','store'));
    }

    public function contact()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('restricted.contact-admin', compact('profileData'));
    }
    public function showPasswordForm()
    {

        return view('restricted.password');
    }

    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        // Check if the provided password matches the logged-in user's password
        if (Hash::check($request->password, Auth::user()->password)) {
            // Set a session variable to allow access to the developer dashboard
            session(['accounts_access_granted' => true]);

            return redirect()->route('restricted.developer_dashboard'); // Matches your route
        }

        return back()->withErrors(['password' => 'Incorrect password. Please try again.']);
    }

    public function developer_dashboard()
    {
        // Check if the session variable is set
        if (!session('accounts_access_granted')) {
            return redirect()->route('restricted.show_password_form'); // Matches your route
        }

        $user = Auth::user();

        // Additional logic for your developer dashboard
        $id = $user->id;
        $profileData = User::find($id);


        return view('restricted.developer_dashboard', compact('profileData'));
    }


        public function traffic()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
             // Get online users (last activity within 5 minutes)
             $onlineUsers = User::with('country')->where('last_activity', '>=', Carbon::now()->subMinutes(5))->get();
             $onlineCount = $onlineUsers->count();

        return view('windows.traffic', compact('onlineUsers', 'onlineCount'));
    }




public function exportDaysToExcel()
{
    return Excel::download(new PayslipDaysExport, 'payslips_days.xlsx');
}




}
