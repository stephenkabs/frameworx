<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use App\Models\Salary;
use App\Models\Detail;
use Illuminate\Support\Str;
use App\Mail\PayslipMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PayslipController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view payslip',['only'=> ['index','show']]);
    //    $this->middleware('permission:create payslip',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit payslip',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete payslip',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $salary = Salary::where('user_id', Auth::id())->get(); // Fetch the results
        $payslip = Payslip::where('user_id', Auth::id())->get(); // Fetch the results

        return view('payslip.index', compact('profileData', 'payslip', 'salary'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $userId = auth()->id();
        $profileData = User::find($id);
        $salary = Salary::where('user_id', $userId)->get();
        $detail = Detail::all();

        return view('payslip.create', compact('profileData','salary','detail'));
    }



public function store(Request $request)
{
    // Validate the input data
    $request->validate([
        'salary_ids' => 'required|array',
        'salary_ids.*' => 'exists:salaries,id',
        'date' => 'required|date',
        'prepared_by' => 'required|string|max:255',
    ]);

    // Retrieve the selected salary IDs
    $salaryIds = $request->input('salary_ids');
    $preparedBy = $request->input('prepared_by');
    $userId = auth()->id();  // Get the logged-in user's ID

    // Iterate through the selected salary IDs and create payslips
    foreach ($salaryIds as $salaryId) {
        $salary = Salary::find($salaryId);

        if ($salary) {
            // Generate a unique slug by appending the current timestamp
            $slugBase = Str::slug($preparedBy); // Base slug from 'prepared_by'
            $slug = $slugBase;

            // Ensure uniqueness of the slug
            $counter = 1;
            while (Payslip::where('slug', $slug)->exists()) {
                $slug = $slugBase . '-' . $counter;
                $counter++;
            }

            // Create the payslip with the user_id filled in automatically
            Payslip::create([
                'salary_id' => $salary->id,
                'date' => $request->input('date'),
                'detail_id' => $request->input('detail_id'),
                'prepared_by' => $preparedBy,
                'slug' => $slug,
                'user_id' => $userId, // Automatically set user_id to the logged-in user
            ]);
        }
    }

    // Redirect with a success message
    return redirect()->route('payslip.index')->with('success', 'Payslips created successfully.');
}


// public function store(Request $request)
// {
//     $request->validate([
//         'salary_ids' => 'required|array',
//         'salary_ids.*' => 'exists:salaries,id',
//         'date' => 'required|date',
//         'prepared_by' => 'required|string|max:255',
//     ]);

//     $salaryIds = $request->input('salary_ids');
//     $preparedBy = $request->input('prepared_by');
//     $userId = auth()->id();

//     foreach ($salaryIds as $salaryId) {
//         $salary = Salary::find($salaryId);

//         if ($salary) {
//             $slugBase = Str::slug($preparedBy);
//             $slug = $slugBase;
//             $counter = 1;
//             while (Payslip::where('slug', $slug)->exists()) {
//                 $slug = $slugBase . '-' . $counter;
//                 $counter++;
//             }

//             // Create the payslip
//             $payslip = Payslip::create([
//                 'salary_id' => $salary->id,
//                 'date' => $request->input('date'),
//                 'detail_id' => $request->input('detail_id'),
//                 'prepared_by' => $preparedBy,
//                 'slug' => $slug,
//                 'user_id' => $userId,
//             ]);

//             // Load related data
//             $payslip = Payslip::with(['worker', 'detail', 'salary'])->find($payslip->id);

//             // Generate PDF
//             $pdf = Pdf::loadView('pdf.payslip', compact('payslip'));

//             // Send email with attached PDF to the worker
//             Mail::to($payslip->worker->email)->send(new PayslipMail($payslip, $pdf));
//         }
//     }

//     return redirect()->route('payslip.index')->with('success', 'Payslips created and emailed successfully.');
// }






    /**
     * Display the specified resource.
     */
    public function show(Payslip $payslip)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $salary = Salary::all();
        return view ('payslip.show', compact('profileData','payslip','salary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payslip $payslip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payslip $payslip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payslip $payslip)
    {
        // if (!Auth::check() || Auth::id() !== $offense->user_id) {
        //     return redirect()->route('offense.index')->with('error', 'Unauthorized access.');
        // }

        $payslip->delete();

        return redirect()->route('payslip.index')->with('success', 'Payslip deleted successfully.');
    }


    public function exportToPDF($slug)
    {
        $payslip = Payslip::with('detail')->where('slug', $slug)->firstOrFail();
        $pdf = Pdf::loadView('pdf.payslip', compact('payslip'));
        return $pdf->download($payslip->worker->name . '.pdf');
    }
    // composer clear-cache
    // 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


}
