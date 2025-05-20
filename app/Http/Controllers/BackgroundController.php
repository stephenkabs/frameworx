<?php

namespace App\Http\Controllers;

use App\Models\Background;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $user = Auth::user();
        $profileData = $user;
        $backgrounds = Background::where('user_id', $user->id)->get();

        return view('background.index', compact('profileData', 'backgrounds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $profileData = Auth::user();

        return view('background.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'type' => 'required|string|max:255',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $user = Auth::user();
        $profileImage = null;

        if ($image = $request->file('image')) {
            $destinationPath = 'background_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        }

        $background = new Background();
        $background->type = $request->input('type');
        $background->user_id = $user->id;
        $background->image = $profileImage;
        $background->save();

        return redirect()->route('background.index')->with('success', 'Image uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Background $background)
    {
        $this->authorize('view', $background);

        $profileData = Auth::user();

        return view('background.show', compact('profileData', 'background'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Background $background)
    {
        $this->authorize('update', $background);

        $profileData = Auth::user();

        return view('background.edit', compact('profileData', 'background'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Background $background)
    {
        // Authorization check
        $this->authorize('update', $background);

        // Validate input
        $request->validate([
            'type' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($image = $request->file('image')) {
            $destinationPath = 'background_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            // Delete the old image if it exists
            if ($background->image && file_exists(public_path($destinationPath . '/' . $background->image))) {
                unlink(public_path($destinationPath . '/' . $background->image));
            }

            // Move the new image to the destination path
            $image->move($destinationPath, $profileImage);
            $background->image = $profileImage;
        }

        // Update type
        $background->type = $request->input('type');

        // Save changes
        $background->save();

        return redirect()->route('background.index')->with('success', 'Background updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Background $background)
    {
     // Check if an image exists and delete it
     if ($background->image && file_exists(public_path('background_images/' . $background->image))) {
        unlink(public_path('background_images/' . $background->image));
    }
        $background->delete();

        return redirect()->route('background.index')->with('success','Image deleted successfully');
    }
}
