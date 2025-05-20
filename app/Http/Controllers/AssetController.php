<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view asset',['only'=> ['index','show']]);
    //    $this->middleware('permission:create asset',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit asset',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete asset',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $asset = Asset::where('user_id','=',$id)->get();
        return view ('asset.index', compact('profileData','asset'));
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
        return view ('asset.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

           // Create a base slug from the name
      $baseSlug = Str::slug($request->input('name'));

      // Initialize slug variable
      $slug = $baseSlug;

      // Check for duplicate slugs
      $counter = 1;
      while (Asset::where('slug', $slug)->exists()) {
          $slug = $baseSlug . '-' . $counter;
          $counter++;
      }

        $post = new Asset();
        $post->name = $request->input('name');
        $post->amount = $request->input('amount');
        $post->asset_description = $request->input('asset_description');
        $post->supplier_name = $request->input('supplier_name');
        $post->supplier_contact = $request->input('supplier_contact');
        $post->delivery_date = $request->input('delivery_date');
        $post->warrant_start_date = $request->input('warrant_start_date');
        $post->warrant_duration = $request->input('warrant_duration');
        $post->attachment_name = $request->input('attachment_name');
        $post->slug = $slug;
        $post->user_id = $user->id;

        if ($image = $request->file('image')) {
            $destinationPath = 'assets_files';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $post->image = $profileImage;
        }

        $post->save();

        return redirect('asset')->with('success', 'Asset created successfully!');
    }

    public function update(Request $request, Asset $asset)
    {
        $input = $request->all();

        // Handle image upload if exists
        if ($image = $request->file('image')) {
            $destinationPath = 'assets_files';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            // Remove the old image if exists
            if ($asset->image && file_exists(public_path("assets_files/{$asset->image}"))) {
                unlink(public_path("assets_files/{$asset->image}"));
            }

            // Upload the new image
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        $asset->update($input);

        return redirect('asset')->with('success', 'Asset updated successfully!');
    }

    /**
 * Show the form for editing the specified resource.
 */
public function edit(Asset $asset)
{
    if (!Auth::check()) {
        return redirect()->route('login');  // Redirect to login if not authenticated
    }

    $id = Auth::user()->id;
    $profileData = User::find($id);

    // Ensure the user has permission to edit this asset
    if ($asset->user_id !== $id) {
        return redirect()->route('asset.index')->with('error', 'Unauthorized access!');
    }

    return view('asset.edit', compact('asset', 'profileData'));
}

/**
 * Display the specified resource.
 */
public function show(Asset $asset)
{
    if (!Auth::check()) {
        return redirect()->route('login');  // Redirect to login if not authenticated
    }

    $id = Auth::user()->id;
    $profileData = User::find($id);

    // Ensure the user has permission to view this asset
    if ($asset->user_id !== $id) {
        return redirect()->route('asset.index')->with('error', 'Unauthorized access!');
    }

    return view('asset.show', compact('asset', 'profileData'));
}


    public function destroy(Asset $asset)
    {
        // Remove the image file if exists
        if ($asset->image && file_exists(public_path("assets_files/{$asset->image}"))) {
            unlink(public_path("assets_files/{$asset->image}"));
        }

        $asset->delete();

        return redirect()->route('asset.index')->with('success', 'Asset deleted successfully!');
    }

}
