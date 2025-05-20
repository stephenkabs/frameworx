<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PricingPlan;
use App\Models\Country;
use App\Models\Donation;
use App\Models\Setting;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view user',['only'=> ['index','show']]);
    //    $this->middleware('permission:create user',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit user',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete user',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $roles = Role::all();

        // Keep relationships loaded
        $users = User::with([ 'pricingPlan'])->get();

        $countries = Country::all();
        $pricingPlan = Auth::user()->pricingPlan; // Get the logged-in user's pricing plan
        $pricingPlans = PricingPlan::all();
        $todayUserCount = User::whereDate('created_at', Carbon::today())->count();

        // Get all records with price = 0
        $freePlans = PricingPlan::where('price', 0)->get();
        $totalPrice = PricingPlan::sum('price'); // Calculate the total price

        return view('user.index', compact('profileData', 'roles', 'users', 'countries', 'pricingPlans', 'pricingPlan', 'todayUserCount', 'freePlans', 'totalPrice'));
    }


    public function updatePricingPlan(Request $request, $slug)
    {
        // Validate the input
        $request->validate([
            'pricing_id' => 'required|exists:pricing_plans,id',
        ]);

        // Find the user by slug
        $user = User::where('slug', $slug)->firstOrFail();

        // Update the pricing plan
        $user->update([
            'pricing_id' => $request->pricing_id,
        ]);

        return redirect()->back()->with('success', 'Pricing plan updated successfully!');
    }


// public function updatePricingPlan(Request $request, $slug)
// {
//     // Validate the input
//     // $request->validate([
//     //     'pricing_id' => 'required|exists:pricing_plans,id',
//     // ]);

//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users,email,',
//         'country_id' => 'nullable|string|max:255',
//         'city' => 'nullable|string|max:255',
//         // 'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
//         'pricing_id' => 'required|exists:pricing_plans,id',
//     ]);


//     // Find the user by slug
//     $user = User::where('slug', $slug)->firstOrFail();

//     // Update the pricing plan
//     $user->update([
//         'pricing_id' => $request->pricing_id,
//         'name' => $request->name,
//         'email' => $request->email,
//         'city' => 'nullable|string|max:255',
//     ]);

//     return redirect()->back()->with('success', 'Pricing plan updated successfully!');
// }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $countries = Country::all();
     // Calculate total monthly sales for approved mobiles
    //  $totalMonthlySales = $user->sum(function ($item) {
    //     return $item->pricingPlan ? $item->pricingPlan->price : 0;


    // });



        return view('user.create', compact('user', 'roles','countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'city' => ['required', 'string', 'max:255'],
            // 'mobile' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'users/images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $profileImagePath = "$profileImage";
        }
        $specialCode = 'USR-' . strtoupper(Str::random(8)); // Generate a unique special code

        $user = User::create([
            'name' => $request->name,
            'pricingPlan_id' => $request->pricingPlan_id,
            'email' => $request->email,
            'image' => $profileImagePath ?? null,
            'password' => Hash::make($request->password),
            'special_code' => $specialCode, // Assign the generated special code
            'slug' => Str::slug($request->name . '-' . Str::random(5)), // Generate a unique slug
        ]);

        $user->syncRoles($request->roles);

        return redirect('user')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        $countries = Country::all();
        return view('user.show', compact('roles', 'user', 'userRoles','countries'));
    }


public function edit(User $user)
{
    $roles = Role::pluck('name', 'name')->all(); // Fetch roles
    $userRoles = $user->roles->pluck('name')->all(); // Fetch the user's roles
    $countries = Country::all(); // Fetch countries

    return view('user.edit', compact('roles', 'user', 'userRoles', 'countries'));
}


public function update(Request $request, User $user)
{
    // Validate incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'country_id' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        'roles' => ['required', 'array'], // Ensure roles is an array
    ]);

    // Prepare data for update
    $data = $request->only(['name', 'email', 'country_id', 'city']);

    // Handle image upload
    if ($image = $request->file('image')) {
        $destinationPath = 'users/images';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);

        // Delete old image if it exists
        if ($user->image && file_exists(public_path("$destinationPath/{$user->image}"))) {
            unlink(public_path("$destinationPath/{$user->image}"));
        }

        $data['image'] = $profileImage;
    }

    // Update password if provided
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

        // Assign roles
        $user->syncRoles($request->roles);

    // Update user details
    $user->update($data);

    return redirect()->route('user.index')->with('success', 'User updated successfully!');
}

public function updateUser(Request $request, $slug)
{
    // Find the user by slug
    $user = User::where('slug', $slug)->firstOrFail();

    // Validate incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'country_id' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'pricing_id' => 'required|exists:pricing_plans,id',
    ]);

    // Prepare data for update
    $data = $request->only(['name', 'email', 'country_id', 'city', 'pricing_id']);

    // Update the user record
    $user->update($data);

    // Redirect with success message
    return redirect()->route('user.index')->with('success', 'User updated successfully!');
}




    /**
     * Calculate and update storage used by a specific user.
     */
    private function updateStorageUsed($userId)
    {
        $user = User::findOrFail($userId);
        $userDirectory = "user_uploads/{$userId}/";
        $totalSize = 0;

        $files = Storage::allFiles($userDirectory);
        foreach ($files as $file) {
            $totalSize += Storage::size($file);
        }

        $user->storage_used = $totalSize;
        $user->save();
    }

    public function updateStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        $message = $user->active ? 'activated' : 'deactivated';
        return redirect()->route('user.index')->with('success', "User {$user->name} has been {$message} successfully!");
    }


    /**
     * Check available storage before uploading.
     */
    public function uploadFile(Request $request)
    {
        $user = auth()->user();
        $this->updateStorageUsed($user->id);

        $storageLimit = 1073741824; // 1GB in bytes

        if (($user->storage_used + $request->file('file')->getSize()) > $storageLimit) {
            return redirect()->back()->withErrors(['error' => 'You have exceeded your storage limit of 1GB.']);
        }

        $filePath = $request->file('file')->store("user_uploads/{$user->id}");
        $this->updateStorageUsed($user->id);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }


    public function destroy(User $user)
{
    // Example: Delete associated image if necessary
    if ($user->image && file_exists(public_path('users/images/' . $user->image))) {
        unlink(public_path('users/images/' . $user->image));
    }

    // Delete the user record
    $user->delete();

    return redirect()->route('user.index')->with('success', 'User deleted successfully!');
}


// public function user($slug)
// {

//     $user = User::with('setting', 'pricingPlan')->where('slug', $slug)->firstOrFail();
//     $pdf = Pdf::loadView('pdf.purchase_receipt', compact('user'));
//     return $pdf->download($user->slug . '.pdf');
// }


public function user($slug)
{
    $user = User::with('setting', 'pricingPlan')->where('slug', $slug)->firstOrFail();

    // Fetch all settings instead of just one
    $generalSetting = Setting::all(); // Returns a collection

    $pdf = Pdf::loadView('pdf.purchase_receipt', compact('user', 'generalSetting'));

    return $pdf->download($user->slug . '.pdf');
}

}
