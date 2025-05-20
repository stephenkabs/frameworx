<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view client',['only'=> ['index','show']]);
    //    $this->middleware('permission:create client',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit client',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete client',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $clients = Client::where('user_id','=',$id)->get();
        return view ('client.index', compact('profileData','clients'));
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
        return view ('client.create', compact('profileData'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'client_name' => 'required|string|max:255',
            // 'client_address' => 'required|string|max:255',
            // 'phone' => 'required|string|max:15', // Fixed typo
            // 'email' => 'required|email|max:255',
            // 'client_tpin' => 'required|string|max:20',
        ]);

        $slug = Str::slug($request->client_name);
        $originalSlug = $slug;
        $count = 1;

        while (Client::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $client = new Client();
        $client->client_name = $request->input('client_name');
        $client->client_address = $request->input('client_address');
        $client->phone = $request->input('phone');
        $client->email = $request->input('email');
        $client->client_tpin = $request->input('client_tpin');
        $client->slug = $slug;
        $client->user_id = $user->id;
        $client->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'client' => $client,
            ]);
        }

        return redirect()->back()->with('success', 'Client created successfully.');
    }


/**
 * Display the specified resource.
 */
public function show(Client $client)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $profileData = Auth::user();
    return view('client.show', compact('client', 'profileData'));
}

/**
 * Show the form for editing the specified resource.
 */
public function edit(Client $client)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $profileData = Auth::user();
    return view('client.edit', compact('client', 'profileData'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, Client $client)
{
    $request->validate([
        'client_name' => 'required|string|max:255',
        'client_address' => 'required|string|max:255',
        // 'phone' => 'required|string|max:15',
        // 'email' => 'required|email|max:255',
        // 'client_tpin' => 'required|string|max:20',
    ]);

    $slug = Str::slug($request->client_name);
    $originalSlug = $slug;
    $count = 1;

    while (Client::where('slug', $slug)->where('id', '!=', $client->id)->exists()) {
        $slug = $originalSlug . '-' . $count;
        $count++;
    }

    $client->update([
        'client_name' => $request->input('client_name'),
        'client_address' => $request->input('client_address'),
        'phone' => $request->input('phone'),
        'email' => $request->input('email'),
        'client_tpin' => $request->input('client_tpin'),
        'slug' => $slug,
    ]);

    return redirect()->route('client.index')->with('success', 'Client updated successfully.');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Client $client)
{
    $client->delete();

    return redirect()->route('client.index')->with('success', 'Client deleted successfully.');
}

}
