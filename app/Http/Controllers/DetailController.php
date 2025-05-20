<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DetailController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view detail',['only'=> ['index','show']]);
    //    $this->middleware('permission:create detail',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit detail',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete detail',['only'=> ['destroy']]);

    // }
    public function index()
    {
        // Fetch all details for the logged-in user
        $details = Detail::where('user_id', Auth::id())->paginate(10);

        return view('details.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('details.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the request inputs (optional, but recommended)
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'website' => 'string|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
    ]);

    // Handle the image upload
    $profileImage = null;
    if ($image = $request->file('image')) {
        // Ensure the destination path is in the public folder
        $destinationPath = public_path('logos');

        // Generate a unique filename for the image
        $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();

        // Move the uploaded file to the destination path
        $image->move($destinationPath, $profileImage);
    }

    // Generate a unique slug based on the name
    $slug = Str::slug($request->input('name'));
    $slugExists = Detail::where('slug', $slug)->exists();
    if ($slugExists) {
        $slug .= '-' . uniqid();
    }

    // Create the detail record
    Detail::create([
        'primary_color' => $request->input('primary_color'),
        'secondary_color' => $request->input('secondary_color'),
        'name' => $request->input('name'),
        'address' => $request->input('address'),
        'website' => $request->input('website'),
        'phone' => $request->input('phone'),
        'email' => $request->input('email'),
        'image' => $profileImage,
        'slug' => $slug,
        'user_id' => Auth::id(),
    ]);

    // Redirect with a success message
    return redirect()->back()->with('success', 'Detail created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Detail $detail)
    {
        // Ensure the user has permission to view this detail
        // $this->authorize('view', $detail);

        return view('details.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detail $detail)
    {
        // Ensure the user has permission to edit this detail
        // $this->authorize('update', $detail);

        return view('details.edit', compact('detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detail $detail)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);

        // Handle the image upload if a new image is provided
        $profileImage = $detail->image; // Keep the existing image
        if ($image = $request->file('image')) {
            $destinationPath = 'logos';
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);

            // Delete the old image if it exists
            if ($detail->image && file_exists(public_path("{$destinationPath}/{$detail->image}"))) {
                unlink(public_path("{$destinationPath}/{$detail->image}"));
            }
        }

        // Generate a unique slug if the name is updated
        $slug = $detail->slug; // Default to the existing slug
        if ($request->input('name') !== $detail->name) {
            $slug = Str::slug($request->input('name'));
            $slugExists = Detail::where('slug', $slug)->where('id', '!=', $detail->id)->exists();
            if ($slugExists) {
                $slug .= '-' . uniqid();
            }
        }

        // Update the detail record
        $detail->update([
            'name' => $request->input('name'),
            'primary_color' => $request->input('primary_color'),
            'secondary_color' => $request->input('secondary_color'),
            'address' => $request->input('address'),
            'website' => $request->input('website'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'image' => $profileImage,
            'slug' => $slug,
        ]);

        return redirect()->route('details.index')->with('success', 'Detail updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detail $detail)
    {
        // Check if the image exists and delete it
        if (!empty($detail->image)) {
            $imagePath = public_path('logos/' . $detail->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the detail
        $detail->delete();

        // Redirect with a success message
        return redirect()->route('details.index')->with('success', 'Detail deleted successfully!');
    }

}
