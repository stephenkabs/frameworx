<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Country;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view branch',['only'=> ['index','show']]);
    //    $this->middleware('permission:create branch',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit branch',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete branch',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $branch = Branch::with('country')->where('user_id','=',$id)->get();

        return view('branches.index', compact('profileData', 'branch'));
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
        $profileData = User::find($id);
        $country = Country::all();
        return view('branches.create', compact('profileData','country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        // Validate the request data
        $request->validate([
            'country_id' => 'required|integer|exists:countries,id',  // country_id must exist in countries table
            'name' => 'required|string|max:255|unique:branches,name', // name must be unique in branches table
            'address' => 'required|string|max:500', // max length for address
            'email' => 'required|email|unique:branches,email|max:255', // valid email format and unique
            'status' => 'required|in:active,inactive', // only allow 'active' or 'inactive' status
        ]);

        // Get the authenticated user


        // Create a new instance of the Branch model
        $file = new Branch();

        // Assign the input values
        $file->country_id = $request->input('country_id');
        $file->name = $request->input('name');
        $file->address = $request->input('address');
        $file->email = $request->input('email');
        $file->status = $request->input('status');
        $file->slug = Str::slug($request->name);
        $file->user_id = Auth::id();

        // Save the model to the database
        $file->save();

        // Redirect to the branches page with a success message
        return redirect('branches')->with('success', 'Branch created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $country = Country::all();

        return view('branches.show', compact('profileData', 'branch', 'country'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $countries = Country::all();

        return view('branches.edit', compact('profileData', 'branch', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $input = $request->all();

        $branch->update($input);

        return redirect('branches')->with('success', 'Branch Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->back()->with('success','Branch Deleted successfully');
    }
}
