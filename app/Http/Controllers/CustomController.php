<?php

namespace App\Http\Controllers;

use App\Models\Custom;
use App\Models\Background;
use App\Models\Hero;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view custom',['only'=> ['index','show']]);
    //    $this->middleware('permission:create custom',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit custom',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete custom',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $custom = Custom::where('user_id','=',$id)->get();
        return view('customs.index', compact('profileData','custom'));
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
        return view('customs.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $baseSlug = Str::slug($request->input('title'));

        // Initialize slug variable
        $slug = $baseSlug;

        // Check for duplicate slugs
        $counter = 1;
        while (Custom::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

            $user = auth()->user();

            $post = new Custom();
            $post->title = $request->input('title');
            $post->type = $request->input('type');
            $post->description = $request->input('description');
            $post->slug = $slug;
            $post->user_id = $user->id;
            $post->save();

            return redirect('customs')->with('success', 'Custom Saved successfully!');
    }


    public function show(Custom $custom)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view('customs.show', compact('profileData','custom'));
    }

    public function public_show(Custom $custom)
    {
        // Retrieve related data
        $heroes = Hero::where('status', 'published')->get();


        // Fetch settings
        $generalSettings = Setting::all();
        $background = Background::all();
        $displaySettings = Setting::where('status', 'Published')->get();

    $features = json_decode($custom->features, true) ?? [];
    if (json_last_error() !== JSON_ERROR_NONE) {
        $features = []; // Fallback to an empty array if JSON is invalid
    }

        // Fetch random similar posts (excluding the current one)
        $documentation = Custom::where('id', '!=', $custom->id)
            ->inRandomOrder() // Random selection
            ->take(50) // Limit to 3 similar ministries
            ->get();

        // Pass 'ministry', 'similarMinistries', and other variables to the view
        return view('customs.public_show', compact('custom',  'generalSettings', 'displaySettings', 'heroes',  'documentation','features','background'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Custom $custom)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view('customs.edit', compact('profileData','custom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Custom $custom)
    {
        $input = $request->all();



  // Check if the title is being updated
  if ($request->has('title') && $custom->title !== $request->input('title')) {
      // Generate a unique slug based on the new title
      $input['slug'] = $this->createUniqueSlug($request->input('title'), $custom->id);
  }

  $custom->update($input);

  return redirect()->back()->with('success', 'Custom Saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Custom $custom)
    {

   $custom->delete();


   return redirect()->back()->with('success','Custom deleted successfully');
    }
}
