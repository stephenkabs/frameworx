<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\UserStoreStatus;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
     // public function __construct()
    // {
    //    $this->middleware('permission:view store',['only'=> ['index','show']]);
    //    $this->middleware('permission:create store',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit store',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete store',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $user = User::find($id);
        $stores = Store::all();

        return view('stores.index', compact('user', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $user = User::find($id);

        return view('stores.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'stream_name' => 'required|string|max:255',
        //     'stream_link' => 'required|url',
        //     'stream_about' => 'required|string',
        //     'type' => 'required|string',
        // ]);

        $profileFile = null;

        if ($file = $request->file('file')) {
            $destinationPath = 'app_icons';
            $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileFile);
        }

        $user = auth()->user();

        // Create the store entry
        $store = Store::create([
            'stream_name' => $request->input('stream_name'),
            'stream_link' => $request->input('stream_link'),
            'stream_about' => $request->input('stream_about'),
            'type' => $request->input('type'),
            'file' => $profileFile,
            'user_id' => $user->id,
        ]);

        // Initialize the status for the creator
        UserStoreStatus::create([
            'user_id' => $user->id,
            'store_id' => $store->id,
            'status' => 'Install', // Creator's status is Install by default
        ]);

        return redirect()->route('stores.index')->with('success', 'Store created successfully!');
    }

    public function install(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:stores,id',
            'status' => 'required|string',
        ]);

        $user = auth()->user();
        $storeId = $request->input('id');
        $status = $request->input('status');

        // Update or create the status for this user
        UserStoreStatus::updateOrCreate(
            ['user_id' => $user->id, 'store_id' => $storeId],
            ['status' => $status]
        );

        return redirect()->back()->with('success', 'Application installed successfully!');
    }



    // public function install(Request $request)
    // {
    //     $store = Store::find($request->input('id'));
    //     if ($store) {
    //         $store->status = 'Install';
    //         $store->save();

    //         return redirect('stores')->with('success', 'Application installed successfully!');
    //     }

    //     return redirect('stores')->with('error', 'Media not found.');
    // }


    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $user = Auth::user();

        return view('stores.show', compact('store', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $user = Auth::user();

        return view('stores.edit', compact('store', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        $request->validate([
            'stream_name' => 'required|string|max:255',
            // 'stream_link' => 'required|url',
            'stream_about' => 'required|string',
            'type' => 'required|string',
            // 'status' => 'required|boolean',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // Handle file upload
        if ($file = $request->file('file')) {
            $destinationPath = 'app_icons';
            $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();

            // Delete the old file if it exists
            if ($store->file && file_exists(public_path($destinationPath . '/' . $store->file))) {
                unlink(public_path($destinationPath . '/' . $store->file));
            }

            // Move the new file to the destination path
            $file->move($destinationPath, $profileFile);
            $store->file = $profileFile;
        }

        // Update other fields
        $store->stream_name = $request->input('stream_name');
        $store->stream_link = $request->input('stream_link');
        $store->stream_about = $request->input('stream_about');
        $store->type = $request->input('type');
        $store->status = $request->input('status');

        // Save the updated store
        $store->save();

        return redirect()->route('stores.index')->with('success', 'Store updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        if ($store->file && file_exists(public_path('app_icons/' . $store->file))) {
            unlink(public_path('app_icons/' . $store->file)); // Delete the associated file
        }

        $store->delete();

        return redirect()->route('stores.index')->with('success', 'Store deleted successfully!');
    }
}
