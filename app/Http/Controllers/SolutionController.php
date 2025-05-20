<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SolutionController extends Controller
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
        $profileData = User::find($id);
        $solution = Solution::all();
        return view ('solutions.index', compact('profileData','solution'));
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
        return view ('solutions.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $post = new Solution();
        $post->content = $request->input('content');
        $post->type = $request->input('type');
        $post->name = $request->input('name');
        $post->user_id = $user->id;
        $post->save();

        session()->flash('success', 'Department created successfully!');
        return redirect('solutions');


    }
    /**
     * Display the specified resource.
     */
    public function show(Solution $solution)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('solutions.show', compact('profileData','solution'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solution $solution)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('solutions.edit', compact('profileData','solution'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solution $solution)
    {
        $input = $request->all();

        $solution->update($input);

        session()->flash('success', 'Department Updated successfully!');
        return redirect('solutions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solution $solution)
    {
        $solution->delete();

        return redirect()->route('solutions.index')->with('success','Department deleted successfully');
    }
}
