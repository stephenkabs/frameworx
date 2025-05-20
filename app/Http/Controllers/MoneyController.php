<?php

namespace App\Http\Controllers;

use App\Models\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class MoneyController extends Controller
{
      // public function __construct()
    // {
    //    $this->middleware('permission:view money',['only'=> ['index','show']]);
    //    $this->middleware('permission:create money',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit money',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete money',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $money = Money::where('user_id', $id)->get(); // Only fetch money records for the logged-in user
        return view('money.index', compact('profileData', 'money'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('money.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'transaction_id' => 'required|string|max:255|unique:money,transaction_id',
            'description' => 'nullable|string|max:500',
        ]);

        $post = new Money();
        $post->name = $request->input('name');
        $post->type = $request->input('type');
        $post->amount = $request->input('amount');
        $post->transaction_id = $request->input('transaction_id');
        $post->description = $request->input('description');

        // Generate a special slug by appending the user ID and a unique hash
        $baseSlug = Str::slug($request->name);
        $uniqueIdentifier = Str::random(6); // Generate a random 6-character string
        $post->slug = "{$baseSlug}-{$user->id}-{$uniqueIdentifier}";

        $post->user_id = $user->id;
        $post->save();

        session()->flash('success', 'Money record created successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Money $money)
    {
        if ($money->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $profileData = Auth::user();
        return view('money.show', compact('money', 'profileData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Money $money)
    {
        if ($money->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $profileData = Auth::user();
        return view('money.edit', compact('money', 'profileData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Money $money)
    {
        if ($money->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'transaction_id' => 'required|string|max:255|unique:money,transaction_id,' . $money->id,
            'description' => 'nullable|string|max:500',
        ]);

        $money->name = $request->input('name');
        $money->type = $request->input('type');
        $money->amount = $request->input('amount');
        $money->transaction_id = $request->input('transaction_id');
        $money->description = $request->input('description');

        // Regenerate slug if name changes
        $baseSlug = Str::slug($request->name);
        $money->slug = "{$baseSlug}-{$money->user_id}-" . Str::random(6);

        $money->save();

        session()->flash('success', 'Money record updated successfully!');
        return redirect()->route('money.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Money $money)
    {
        if ($money->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $money->delete();

        session()->flash('success', 'Money record deleted successfully!');
        return redirect()->route('money.index');
    }
}
