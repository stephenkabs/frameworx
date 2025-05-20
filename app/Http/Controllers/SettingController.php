<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view setting',['only'=> ['index','show']]);
    //    $this->middleware('permission:create setting',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit setting',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete setting',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $setting = Setting::all();
        return view ('setting.index', compact('profileData','setting'));
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
        $settings = Setting::all();
        return view ('setting.create', compact('profileData','settings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'title' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'about' => 'nullable|string',
        'phone' => 'nullable|string',
        'address' => 'nullable|string',
        'version' => 'required|string|max:50',
        'email' => 'required|email|max:255',
        'copyright' => 'nullable|string|max:255',
        'web_color' => 'nullable|string|max:7', // Assuming this is a hex code
        'footer_color' => 'nullable|string|max:7', // Assuming this is a hex code
        // 'status' => 'required|in:active,inactive', // Status must be either 'active' or 'inactive'
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate the image file
        // 'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120' // Validate the file (PDF, DOC, DOCX)
         'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120' // Validate the file (PDF, DOC, DOCX)
    ]);

    // Handle image upload
    if ($image = $request->file('image')) {
        $destinationPath = 'settings/logo_dark';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $post['image'] = "$profileImage";
    }

    // Handle file upload
    if ($file = $request->file('file')) {
        $destinationPath = 'settings/logo_white';
        $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath, $profileFile);
        $post['image'] = "$profileFile";
    }

    // Assign data to the Setting model
    $user = auth()->user();
    $post = new Setting();
    $post->title = $request->input('title');
    $post->name = $request->input('name');
    $post->about = $request->input('about');
    $post->version = $request->input('version');
    $post->email = $request->input('email');
    $post->phone = $request->input('phone');
    $post->address = $request->input('address');
    $post->copyright = $request->input('copyright');
    $post->web_color = $request->input('web_color');
    $post->footer_color = $request->input('footer_color');
    $post->status = $request->input('status');
    $post->slug = Str::slug($request->title);
    $post->image = $profileImage ?? null;
    $post->file = $profileFile ?? null;
    $post->user_id = $user->id;
    $post->save();

    // Redirect back with success message
    return redirect('setting')->with('success', 'Goal created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('setting.show', compact('profileData','setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('setting.edit', compact('profileData','setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $input = $request->all();

        // Handle the 'image' upload
        if ($image = $request->file('image')) {
            $destinationPath = 'settings/logo_dark';

            // Delete the old image if it exists
            if ($setting->image) {
                $oldImagePath = public_path($destinationPath . '/' . $setting->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage; // Use correct key here

        } else {
            unset($input['image']);
        }

        // Handle the 'file' upload
        if ($file = $request->file('file')) {
            $destinationPath = 'settings/logo_white';

            // Delete the old file if it exists
            if ($setting->file) { // Assuming 'file' is the field name for the uploaded file
                $oldFilePath = public_path($destinationPath . '/' . $setting->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileFile);
            $input['file'] = $profileFile; // Use correct key here
        } else {
            unset($input['file']);
        }

        // Update the setting record with the new data
        $setting->update($input);

        return redirect()->route('setting.index')->with('message', 'Member updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        // Define the paths for image and file
        $imagePath = 'settings/logo_dark/' . $setting->image;
        $filePath = 'settings/logo_white/' . $setting->file;

        // Delete the image if it exists
        if ($setting->image && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        // Delete the file if it exists
        if ($setting->file && file_exists(public_path($filePath))) {
            unlink(public_path($filePath));
        }

        // Delete the Setting record
        $setting->delete();

        // Redirect back with success message
        return redirect()->route('setting.index')->with('Message', 'Setting deleted successfully');
    }

}
