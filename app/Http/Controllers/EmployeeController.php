<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $department = Department::where('user_id','=',$id)->get();
        $employee = Employee::where('user_id','=',$id)->get();
        $country = Country::all();
        return view ('employee.index', compact('profileData','department','country','employee'));
    }

//     public function getAdvanceAmount($id)
// {
//     $employee = Employee::find($id);
//     if ($employee) {
//         // Assuming you have a method to get the advance amount
//         $advanceAmount = $employee->getAdvanceAmount();
//         return response()->json(['advanceAmount' => $advanceAmount]);
//     }
//     return response()->json(['advanceAmount' => 0]);
// }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $department = Department::all();
        $country = Country::all();
        return view ('employee.create', compact('profileData','department','country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'information' => 'required|string',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048|nullable',
        //     'file' => 'required |file|mimes:pdf,csv,doc|max:2048',


        // ]);

        $user = auth()->user();
        if ($image = $request->file('image')) {
            $destinationPath = 'employees/images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $post['image'] = "$profileImage";
        }
        if ($file = $request->file('file')) {
            $destinationPath = 'employees/files';
            $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileFile);
            $post['image'] = "$profileFile";
        }

        $user = auth()->user();
        $post = new Employee();
        $post->department_id = $request->input('department_id');
        $post->name = $request->input('name');
        $post->email = $request->input('email');
        $post->phone_number = $request->input('phone_number');
        $post->status = $request->input('status');
        $post->address = $request->input('address');
        $post->qualification = $request->input('qualification');
        $post->position = $request->input('position');
        $post->gender = $request->input('gender');
        $post->account_name = $request->input('account_name');
        $post->bank_name = $request->input('bank_name');
        $post->account_no = $request->input('account_no');
        $post->next_of_kin = $request->input('next_of_kin');
        $post->kin_number = $request->input('kin_number');
        $post->amount = $request->input('amount');
        $post->date_of_birth = $request->input('date_of_birth');
        $post->employee_number = $request->input('employee_number');
        $post->health_insurance_no = $request->input('health_insurance_no');
        $post->country_id = $request->input('country_id');
        $post->pension_no = $request->input('pension_no');
        $post->marital_status = $request->input('marital_status');
        $post->image = $profileImage;
        $post->file = $profileFile;
        $post->user_id = $user->id;
        $post->save();

        return redirect('employee')->with('success', 'Goal created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $department = Department::all();
        $country = Country::all();
        return view ('employee.show', compact('profileData','department','country', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $department = Department::all();
        $country = Country::all();
        return view ('employee.edit', compact('profileData','department','country', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {



        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'employees/images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";

        }else{
            unset($input['image']);


        }
        if ($file = $request->file('file')) {
            $destinationPath = 'employees/files';
            $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileFile);
            $input['image'] = "$profileFile";
        }
        else{
            unset($input['image']);
        }

        $employee->update($input);

        return redirect()->route('employee.index')->with('message','Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employee.index')->with('Message','Expense deleted successfully');
    }
}
