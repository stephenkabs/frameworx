<?php

namespace App\Http\Controllers;

use App\Models\Update;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Sign;
use App\Models\Hero;
use App\Models\About;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\Leader;
use App\Models\Ministry;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class UpdateController extends Controller
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
        $updates = Update::all();

        $agent = new Agent();
        if ($agent->isMobile()) {
            // Load a separate view for mobile devices
            return view ('update.mobile_index', compact('profileData','updates'));
        }

        return view ('update.index', compact('profileData','updates'));
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

        return view ('update.create', compact('profileData',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = auth()->user();
        $profileImage = null; // Initialize the variable

        if ($image = $request->file('image')) {
            $destinationPath = 'updates';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        }

        // Create a new instance of the Brand model
        $file = new Update();

        // Assign the input values
        $file->title = $request->input('title');
        $file->target_type = $request->input('target_type');
        $file->target = $request->input('target');
        $file->time = $request->input('time');
        $file->date = $request->input('date');
        $file->venue = $request->input('venue');
        $file->status = $request->input('status');
        $file->slug = Str::slug($request->title);
        $file->about_event = $request->input('about_event');
        $file->user_id = $user->id;

        // Set the image if it was uploaded
        if ($profileImage) {
            $file->image = $profileImage;
        }

        // Save the model to the database
        $file->save();

        // Redirect to the brands page with a success message
        return redirect('update')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Update $update)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login');  // Redirect to login if not authenticated
    //     }
    //     $id=Auth::user()->id;
    //     $profileData = User::find($id);
    //     $signs = Sign::where('update_id', $update->id)->get();

    //     return view ('update.show', compact('profileData','update','signs'));
    // }

    public function show(Update $update)
{
    // Check if the user is authenticated
    if (Auth::check()) {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $signs = Sign::where('update_id', $update->id)->get();
        // $heroes = Hero::where('status', 'published')->get();
        // $ministries = Ministry::all();

        // Fetch two different sets of settings
        $generalSettings = Setting::where('status', 'Published')->get();
        $displaySettings = Setting::where('status', 'Published')->get();


        // Return the dashboard view for authenticated users
        return view('update.show', compact('profileData', 'update', 'signs'));
    }

    // For public view (non-authenticated users), just return the event details without profile and signs
    return view('update.public_show', compact('update'));
}

public function public_show(Update $update)
{
    // // Retrieve any other related data (e.g., signs) if needed
    // $signs = Sign::where('update_id', $update->id)->get();
    // $heroes = Hero::where('status', 'published')->get();
    // $about = About::where('status', 'Published')->get();
    // $news = News::all();
    // $contact = Contact::all();
    // $similarMinistries = Ministry::all();
    // // Fetch two different sets of settings
    // $generalSettings = Setting::all();
    // $displaySettings = Setting::where('status', 'Published')->get();

    // // Return the public_show view with the update and signs data
    // return view('update.public_show', compact('update', 'signs','generalSettings','displaySettings','heroes','update','about','news','contact','similarMinistries'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Update $update)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('update.edit', compact('profileData','update'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Update $update)
    {
        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'updates';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $update->update($input);
        return redirect('update')->with('success', 'Event Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Update $update)
    {
        $update->delete();
        return redirect('update')->with('success', 'Event deleted successfully!');
    }
}
