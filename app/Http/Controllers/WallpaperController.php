<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

class WallpaperController extends Controller
{


public function updateWallpaper(Request $request)
{
    // Validate the incoming request (ensure either wallpaper is selected or file is uploaded)
    $request->validate([
        'wallpaper' => 'required_without:file',
        'file' => 'nullable|image',
    ]);

    $user = auth()->user();

    // Get the currently authenticated user
    // Handle file upload if a new wallpaper is uploaded
    if ($request->hasFile('file')) {
        // Store the new wallpaper and get its path
        $path = $request->file('file')->store('public/wallpapers');
        $wallpaperPath = str_replace('public/', 'storage/', $path);
        $user->wallpaper = $wallpaperPath; // Save the new wallpaper path
    } else {
        $user->wallpaper = $request->input('wallpaper'); // Save the selected wallpaper
    }

    $user->save(); // Persist changes to the database


    return redirect()->back()->with('success', 'Wallpaper updated successfully!');
}





public function showWallpaperSelection()
{
    // Fetch available wallpapers from the storage
    $wallpapers = collect(Storage::files('public/wallpapers'))->map(function ($path) {
        return str_replace('public/', 'storage/', $path);
    });

    return view('wallpaper-selection', compact('wallpapers'));
}






}
