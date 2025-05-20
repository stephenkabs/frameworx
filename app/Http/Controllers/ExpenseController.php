<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Admin;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view expense',['only'=> ['index','show']]);
    //    $this->middleware('permission:create expense',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit expense',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete expense',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $expense = Expense::where('user_id','=',$id)->get();
        return view ('expenses.index', compact('profileData','expense'));
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
        $expense = Expense::all();
        return view ('expenses.create', compact('profileData','expense'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $user = auth()->user();

    $expense = new Expense();

    // Handle image upload if provided
    if ($image = $request->file('image')) {
        $destinationPath = 'expense';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $expense->image = $profileImage;
    } else {
        $expense->image = null; // Set null if no image is uploaded
    }

      // Create a base slug from the name
      $baseSlug = Str::slug($request->input('expense_name'));

      // Initialize slug variable
      $slug = $baseSlug;

      // Check for duplicate slugs
      $counter = 1;
      while (Expense::where('slug', $slug)->exists()) {
          $slug = $baseSlug . '-' . $counter;
          $counter++;
      }

    $expense->expense_name = $request->input('expense_name');
    $expense->expense_type = $request->input('expense_type');
    $expense->date_time = $request->input('date_time');
    $expense->amount = $request->input('amount');
    $expense->slug = $slug;
    $expense->attachment_name = $request->input('attachment_name') ?? null; // Handle null for attachment_name
    $expense->expense_note = $request->input('expense_note') ?? null; // Handle null for expense_note
    $expense->user_id = $user->id;

    // Save the expense
    $expense->save();

    return redirect('expenses')->with('success', 'Expense created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('expenses.show', compact('profileData','expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('expenses.edit', compact('profileData','expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $input = $request->all();

        // Handle image upload
        if ($image = $request->file('image')) {
            $destinationPath = 'expense';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            // Delete the old image if it exists
            if ($expense->image && file_exists(public_path($destinationPath . '/' . $expense->image))) {
                unlink(public_path($destinationPath . '/' . $expense->image));
            }

            // Move the new image to the destination path
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        } else {
            unset($input['image']);
        }

        // Update the expense with the new input data
        $expense->update($input);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
  /**
 * Remove the specified resource from storage.
 */
public function destroy(Expense $expense)
{
    // Check if an image exists and delete it
    if ($expense->image && file_exists(public_path('expense/' . $expense->image))) {
        unlink(public_path('expense/' . $expense->image));
    }

    // Delete the expense record
    $expense->delete();

    return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully');
}

}
