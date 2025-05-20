<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SalaryController extends Controller
{
    //   public function __construct()
    // {
    //    $this->middleware('permission:view salary',['only'=> ['index','show']]);
    //    $this->middleware('permission:create salary',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit salary',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete salary',['only'=> ['destroy']]);

    // }
    public function index()
    {
        // Get all salaries or implement any filtering if required
        $salaries = Salary::with('employee')->get();
        $employee = Employee::where('user_id', Auth::id());
        return view('salaries.index', compact('salaries','employee')); // Adjust the view name as needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = Employee::where('user_id', Auth::id());
        return view('salaries.create', compact('employee')); // Create form view for salary
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            // 'employee_id' => 'required|integer|exists:employees,id',
            'basic_salary' => 'required|numeric|min:0',
            'housing_allowance' => 'nullable|numeric|min:0',
            'transport_allowance' => 'nullable|numeric|min:0',
            'other_allowance' => 'nullable|numeric|min:0',
            'other_allowance_two' => 'nullable|numeric|min:0',
            'payee' => 'required|numeric|min:0',
            'napsa' => 'required|numeric|min:0',
            'nhima' => 'required|numeric|min:0',
            'net_pay' => 'required|numeric|min:0',
        ]);

        // Create a new salary record
        $salary = new Salary();

        // Assign the validated data to the model
        $salary->worker_id = $request->input('worker_id');
        $salary->basic_salary = $request->input('basic_salary');
        $salary->housing_allowance = $request->input('housing_allowance');
        $salary->transport_allowance = $request->input('transport_allowance');
        $salary->other_allowance = $request->input('other_allowance');
        $salary->other_allowance_two = $request->input('other_allowance_two');
        $salary->payee = $request->input('payee');
        $salary->napsa = $request->input('napsa');
        $salary->nhima = $request->input('nhima');
        $salary->daily_earnings = $request->input('daily_earnings');
        $salary->daily_hourly = $request->input('daily_hourly');
        $salary->monthly_working_days = $request->input('monthly_working_days');
        $salary->net_pay = $request->input('net_pay');
        $salary->user_id = Auth::id();

        // Generate a unique slug for the salary record
        $salary->slug = Str::slug($salary->payee . '-' . uniqid());

        // Save the salary record to the database
        $salary->save();

        return redirect()->back()->with('success', 'Salary details saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        return view('salaries.show', compact('salary')); // Show specific salary details
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        return view('salaries.edit', compact('salary')); // Edit form for salary
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            // 'worker_id' => 'nullable|exists:employees,id',
            'basic_salary' => 'required|string',
            'housing_allowance' => 'required|string',
            'transport_allowance' => 'required|string',
            'other_allowance' => 'required|string',
            'other_allowance_two' => 'required|string',
            'payee' => 'required|string',
            'napsa' => 'required|string',
            'nhima' => 'required|string',
            'net_pay' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        // Update the salary record
        $salary->worker_id = $request->input('worker_id');
        $salary->basic_salary = $request->input('basic_salary');
        $salary->housing_allowance = $request->input('housing_allowance');
        $salary->transport_allowance = $request->input('transport_allowance');
        $salary->other_allowance = $request->input('other_allowance');
        $salary->other_allowance_two = $request->input('other_allowance_two');
        $salary->payee = $request->input('payee');
        $salary->napsa = $request->input('napsa');
        $salary->nhima = $request->input('nhima');
        $salary->monthly_working_days = $request->input('monthly_working_days');
        $salary->daily_hourly = $request->input('daily_hourly');
        $salary->daily_earnings = $request->input('daily_earnings');
        $salary->net_pay = $request->input('net_pay');
        $salary->user_id = Auth::id();


        // Update the slug if necessary
        $salary->slug = Str::slug($salary->payee . '-' . uniqid());

        // Save the updated record
        $salary->save();

        return redirect()->back()->with('success', 'Salary details updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        // Delete the salary record
        $salary->delete();

        return redirect()->back()->with('success', 'Salary details deleted successfully!');
    }
}
