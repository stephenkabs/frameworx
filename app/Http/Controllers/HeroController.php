<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view hero',['only'=> ['index','show']]);
    //    $this->middleware('permission:create hero',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit hero',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete hero',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $hero = Hero::all();
        return view ('heros.index', compact('profileData','hero'));
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
        return view ('heros.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $user = auth()->user();
        // Create a new instance of the Brand model
        $file = new Hero();

        // Assign the input values
        $file->title = $request->input('title');
        $file->button_name = $request->input('button_name');
        $file->button_link = $request->input('button_link');
        $file->about = $request->input('about');
        $file->slug = Str::slug($request->title);
        $file->status = $request->input('status');

        $file->user_id = $user->id;



        // Save the model to the database
        $file->save();

        // Redirect to the brands page with a success message
        return redirect('heros')->with('success', 'Goal created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('heros.show', compact('profileData','hero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('heros.edit', compact('profileData','hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero $hero)
    {
         // Get all form inputs
         $input = $request->all();

         $hero->update($input);

         session()->flash('success', 'Department Updated successfully!');
         return redirect('heros');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {


        $hero->delete();
        return redirect()->back()->with('success', 'Hero updated successfully');
    }
}
