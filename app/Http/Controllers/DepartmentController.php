<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view department',['only'=> ['index','show']]);
    //    $this->middleware('permission:create department',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit department',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete department',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $department = Department::all();
        return view ('departments.index', compact('profileData','department'));
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
        $profileData = User::find($id);
        return view ('departments.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {


        // Create a base slug from the name
        $baseSlug = Str::slug($request->input('name'));

        // Initialize slug variable
        $slug = $baseSlug;

        // Check for duplicate slugs
        $counter = 1;
        while (Department::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Save the department
        $post = new Department();
        $post->name = $request->input('name');
        $post->slug = $slug;
        $post->user_id = Auth::id();
        $post->save();

        // Flash success message and redirect
        session()->flash('success', 'Department created successfully!');
        return redirect('departments');
    }


    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('departments.show', compact('profileData','department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('departments.edit', compact('profileData','department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {

            $input = $request->all();

            $department->update($input);

            session()->flash('success', 'Department Updated successfully!');
            return redirect('departments');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success','Department deleted successfully');
    }
}
