<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Salary;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WorkerController extends Controller
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
        $department = Department::where('user_id','=',$id)->get();
        $branch = Branch::where('user_id','=',$id)->get();
        $worker = Worker::where('user_id','=',$id)->get();
        $attendance = Attendance::where('user_id','=',$id)->get();
        // $employee = Employee::all();
        return view('worker.index', compact('department','branch','worker','attendance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $department = Department::all();
        $branch = Branch::where('user_id','=',$id)->get();
        return view('worker.create', compact('department','branch'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'nrc' => 'required|string|max:255',
            'nhima_no' => 'required|string|max:255',
            'napsa_no' => 'required|string|max:255',
            'email' => 'required|email|unique:workers,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string',
            'birthday' => 'nullable|date',
            'bank_name' => 'nullable|string',
            'account_number' => 'nullable|string',
            'bank_code' => 'nullable|string',
            'tax_id' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'branch_id' => 'nullable|exists:branches,id',
            'designation' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
            'file' => 'nullable|file',
        ]);

        // Initialize variables
        $profileImage = null;
        $documents = null;

        // Handle image upload
        if ($image = $request->file('image')) {
            $destinationPath = 'employee_profile';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        }

        // Handle document upload
        if ($file = $request->file('file')) {
            $destinationPath = 'documents';
            $documents = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $documents);
        }

        // Create a new instance of the Employee model
        $employee = new Worker();

        // Assign the input values
        $employee->name = $request->input('name');
        $employee->nrc = $request->input('nrc');
        $employee->nhima_no = $request->input('nhima_no');
        $employee->napsa_no = $request->input('napsa_no');
        $employee->join_date = $request->input('join_date');
        $employee->address = $request->input('address');
        $employee->branch_id = $request->input('branch_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->birthday = $request->input('birthday');
        $employee->bank_name = $request->input('bank_name');
        $employee->account_number = $request->input('account_number');
        $employee->mm_number = $request->input('mm_number');
        $employee->mm_name = $request->input('mm_name');

        // Generate a unique slug based on the name
        $slug = Str::slug($request->input('name'));

        // Check if the slug already exists in the database
        $slugExists = Worker::where('slug', $slug)->exists();
        if ($slugExists) {
            // If the slug exists, append a unique ID or timestamp
            $slug .= '-' . uniqid();
        }

        // Assign the unique slug to the employee
        $employee->slug = $slug;

        $employee->designation = $request->input('designation');
        $employee->branch_location = $request->input('branch_location');
        $employee->account_name = $request->input('account_name');
        $employee->gender = $request->input('gender');
        $employee->bank_code = $request->input('bank_code');
        $employee->tax_id = $request->input('tax_id');
        $employee->department_id = $request->input('department_id');
        $employee->tracking_code = $this->generateTrackingCode();

        // Set the user_id for the currently authenticated user
        $employee->user_id = Auth::id(); // Use the ID of the currently logged-in user

        // Set the image if it was uploaded
        if ($profileImage) {
            $employee->image = $profileImage;
        }

        // Set the file if it was uploaded
        if ($documents) {
            $employee->file = $documents;
        }

        // Save the model to the database
        $employee->save();

        return redirect('worker')->with('success', 'Employee created successfully!');
    }

    private function generateTrackingCode()
    {
        // Get the last numeric part of the tracking code
        $lastCode = Worker::where('tracking_code', 'LIKE', 'Emp_%')
            ->orderBy('tracking_code', 'desc')
            ->value('tracking_code');

        // Extract the numeric part and increment it
        $nextNumber = $lastCode ? intval(substr($lastCode, 4)) + 1 : 1;

        // Format the new tracking code with leading zeros (e.g., Emp_001)
        $newCode = 'Emp_' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return $newCode;
    }

    public function show(Worker $worker)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Use $worker->id instead of $salary->id
        $salary = Salary::where('worker_id', $worker->id)->first();
        $workers = Worker::all();
        return view('worker.show', compact('worker', 'salary','workers'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Worker $worker)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $id = Auth::user()->id;
        $departments = Department::where('user_id', $id)->get();
        $branches = Branch::where('user_id', $id)->get();

        return view('worker.edit', compact('worker', 'departments', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Worker $worker)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nrc' => 'required|string|max:255',
            'napsa_no' => 'required|string|max:255',
            'nhima_no' => 'required|string|max:255',
            'mm_number' => 'required|string|max:255',
            'mm_name' => 'required|string|max:255',
            'email' => 'required|email|unique:workers,email,' . $worker->id,
            'phone' => 'nullable|string',
            'birthday' => 'nullable|date',
            'bank_name' => 'nullable|string',
            'account_number' => 'nullable|string',
            'bank_code' => 'nullable|string',
            'tax_id' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'branch_id' => 'nullable|exists:branches,id',
            'designation' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
            'file' => 'nullable|file',
        ]);

        // Handle image upload
        if ($image = $request->file('image')) {
            $destinationPath = 'employee_profile';
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $worker->image = $profileImage;
        }

        // Handle document upload
        if ($file = $request->file('file')) {
            $destinationPath = 'documents';
            $documents = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $documents);
            $worker->file = $documents;
        }

        $worker->update($request->except(['image', 'file']));

        return redirect()->route('worker.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $worker->delete();

        return redirect()->route('worker.index')->with('success', 'Employee deleted successfully!');
    }
}
