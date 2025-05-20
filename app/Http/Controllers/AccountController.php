<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Money;
use App\Models\Expense;
use App\Models\Salary;
use App\Models\Asset;
use App\Models\Worker;
use App\Models\Background;
use App\Models\Quotation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view account',['only'=> ['index','show']]);
    //    $this->middleware('permission:create account',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit account',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete account',['only'=> ['destroy']]);

    // }
    public function showPasswordForm()
    {
        $background = Background::all();
        return view('accounts.password', compact('background'));
    }

    // Verify the user's password
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        // Check if the provided password matches the logged-in user's password
        if (Hash::check($request->password, Auth::user()->password)) {
            // Set a session variable to allow access to the accounts index page
            session(['accounts_access_granted' => true]);

            return redirect()->route('accounts.index');
        }

        return back()->withErrors(['password' => 'Incorrect password. Please try again.']);
    }
    public function index()
    {
            // Check if the user has been granted access via session
    if (!session('accounts_access_granted')) {
        return redirect()->route('accounts.password');
    }
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $account = Account::where('user_id','=',$id)->get();
        $totalTithingDonations = Money::where('description', 'yearly_savings')->sum('amount');
        $totalProjectDonations = Money::where('description', 'monthly_savings')->sum('amount');
        $totalOfferingDonations = Money::where('description', 'daily_savings')->sum('amount');
        $totalOtherDonations = Money::where('description', 'Other')->sum('amount');
        $main = Money::where('user_id','=',$id)->get();
        $expense = Expense::where('user_id','=',$id)->get();
        $asset = Asset::where('user_id','=',$id)->get();
        $worker = Worker::where('user_id','=',$id)->get();
        $salary = Salary::where('user_id','=',$id)->get();
        $quotations = Quotation::where('user_id','=',$id)->get();
        return view('accounts.index', compact('profileData','account','totalTithingDonations', 'totalProjectDonations', 'totalOfferingDonations', 'totalOtherDonations','main','expense','asset','worker','salary','quotations'));
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
        $clients = User::all();
        return view ('accounts.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validated = $request->validate([
            'account_name' => 'required|string|max:255|unique:accounts,account_name',
            'name' => 'required|string|max:255',
            'account_number' => 'required|numeric|unique:accounts,account_number',
            'swift_code' => 'required|string|max:11',
            'sort_code' => 'required|string|max:6',
            'currency' => 'required|string|max:20',
            'branch' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'target' => 'required|string|max:255',
        ]);

        // Retrieve the authenticated user
        $user = auth()->user();

        try {
            // Create the new account
            $post = new Account();
            $post->account_name = $request->input('account_name');
            $post->name = $request->input('name');
            $post->account_number = $request->input('account_number');
            $post->swift_code = $request->input('swift_code');
            $post->sort_code = $request->input('sort_code');
            $post->currency = $request->input('currency');
            $post->branch = $request->input('branch');
            $post->type = $request->input('type');
            $post->target = $request->input('target');

            // Create a unique slug by appending a random string or account number
            $slug = Str::slug($request->input('account_name'));

            // Check if the slug already exists in the database
            $existingSlugCount = Account::where('slug', $slug)->count();

            if ($existingSlugCount > 0) {
                // Append a unique identifier (like a random string or account number) to the slug
                $slug .= '-' . uniqid();
            }

            $post->slug = $slug;
            $post->user_id = $user->id;
            $post->save();

            // Flash success message and redirect if successful
            session()->flash('success', 'Account created successfully!');
            return redirect('accounts');

        } catch (QueryException $e) {
            // Check if it's a unique constraint violation error
            if ($e->getCode() == 23000) {
                // Flash an error message for a duplicate entry
                session()->flash('error', 'An account with this name or number already exists. Please use a different name or account number.');
                return redirect()->back()->withInput();
            }

            // Flash a general error if it's another type of error
            session()->flash('error', 'An error occurred. Please try again.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('accounts.edit', compact('profileData','account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $input = $request->all();

            $account->update($input);

            session()->flash('success', 'Account Updated successfully!');
            return redirect('accounts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
        session()->flash('success', 'Account Deleted successfully!');
        return redirect('accounts');
    }
}
