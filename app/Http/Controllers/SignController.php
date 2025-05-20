<?php

namespace App\Http\Controllers;

use App\Models\Sign;
use App\Models\Update;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class SignController extends Controller
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
            // Get all signs with their related updates
            $signs = Sign::withCount('updates')->get();

            //  $totalMembers = Sign::where('updates_id', $id)->count();

            return view('sign.index', compact('signs','profileData'));

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
            $update = Update::all();


            $agent = new Agent();
            if ($agent->isMobile()) {
                // Load a separate view for mobile devices
                return view ('sign.mobile_create', compact('profileData','update'));
            }


            return view ('sign.create', compact('profileData','update'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


// $user = auth()->user();


$post = new Sign();
$post->name = $request->input('name');
$post->date = $request->input('date');
$post->type = $request->input('type');
$post->update_id = $request->input('update_id');
// $post->slug = Str::slug($request->email);
$post->email = $request->input('email');
$post->number = $request->input('number');
$post->address= $request->input('address');
// $post->user_id = $user->id;
$post->save();

return redirect()->back()->with('success', 'Congratulation you have managed to Register successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sign $sign)
    {

        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
            // Get all signs with their related updates


            return view('sign.show', compact('sign','profileData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sign $sign)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
            // Get all signs with their related updates


            return view('sign.edit', compact('sign','profileData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sign $sign)
    {
       $input = $request->all();
       $sign->update($input);
       return redirect('sign')->with('success', 'Registration Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sign $sign)
    {
        $sign->delete();
        return redirect()->back()->with('success', 'Register deleted successfully');
    }
}
