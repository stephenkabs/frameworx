<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use App\Models\Background;
use App\Models\Hero;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


class DocController extends Controller
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
        $doc = Doc::all();
        return view('doc.index', compact('profileData','doc'));
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
        return view('doc.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $user = auth()->user();

        $post = new Doc();
        $post->title = $request->input('title');
        $post->type = $request->input('type');
        $post->description = $request->input('description');
        $post->slug = $this->createUniqueSlug($request->input('title'));
        $post->user_id = $user->id;
        $post->save();

        return redirect('doc')->with('success', 'Doc Saved successfully!');
    }

    protected function createUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;

        // Check for duplicates
        $i = 1;
        while (Doc::where('slug', $slug)->where('id', '<>', $id)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }

    public function show(Doc $doc)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view('doc.show', compact('profileData','doc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doc $doc)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view('doc.edit', compact('profileData','doc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doc $doc)
    {
        $input = $request->all();



        // Check if the title is being updated
        if ($request->has('title') && $doc->title !== $request->input('title')) {
            // Generate a unique slug based on the new title
            $input['slug'] = $this->createUniqueSlug($request->input('title'), $doc->id);
        }

        $doc->update($input);

        return redirect()->back()->with('success', 'Doc Saved successfully');
    }

    public function public_show(Doc $doc)
{
    // Retrieve related data
    $heroes = Hero::where('status', 'published')->get();


    // Fetch settings
    $generalSettings = Setting::all();
    $background = Background::all();
    $displaySettings = Setting::where('status', 'Published')->get();

$features = json_decode($doc->features, true) ?? [];
if (json_last_error() !== JSON_ERROR_NONE) {
    $features = []; // Fallback to an empty array if JSON is invalid
}

    // Fetch random similar posts (excluding the current one)
    $documentation = Doc::where('id', '!=', $doc->id)
        ->inRandomOrder() // Random selection
        ->take(50) // Limit to 3 similar ministries
        ->get();

    // Pass 'ministry', 'similarMinistries', and other variables to the view
    return view('doc.public_show', compact('doc',  'generalSettings', 'displaySettings', 'heroes',  'documentation','features','background'));
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doc $doc)

    {

        $doc->delete();


        return redirect()->back()->with('success','Doc deleted successfully');
    }
}
