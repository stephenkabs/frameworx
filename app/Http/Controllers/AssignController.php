<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignController extends Controller
{
    /**
     * Display a listing of all assignments.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        // Fetch assignments along with related users and documents
        $assignments = Assign::with(['user', 'document'])->get();

        return view('assign.index', compact('assignments'));
    }


    public function myDocuments()
    {
        // Get the logged-in user ID
        $userId = auth()->id();

        // Fetch assigned documents for this user
        $documents = Assign::where('user_id', $userId)
            ->with('document') // Ensure 'document' relationship is defined in Assign model
            ->get();

        return view('assign.my_documents', compact('documents'));
    }



    /**
     * Show the form for creating a new assignment.
     */
    public function create()
    {
        $users = User::all();

        // Fetch documents that are not assigned in the 'assigns' table
        $documents = Document::whereDoesntHave('assigns')->get();

        return view('assign.create', compact('users', 'documents'));
    }

    /**
     * Store a new assignment (assign multiple documents to a user).
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:documents,id',
        ]);

        foreach ($request->document_ids as $document_id) {
            Assign::create([
                'user_id' => $request->user_id, // Ensure user_id is set
                'document_id' => $document_id,
            ]);
        }

        return redirect()->route('assign.index')->with('success', 'Documents assigned successfully!');
    }


    /**
     * Display the details of a specific assignment.
     */
    public function show(Assign $assign)
    {
        return view('assign.show', compact('assign'));
    }

    /**
     * Show the form for editing a user's assignments.
     */
//     public function edit(Assign $assign)
//     {
//         if (!Auth::check()) {
//             return redirect()->route('login');
//         }

//         $users = User::all();
//         // $documents = Document::all();
//         // $assignedDocuments = $assign->documents->pluck('id')->toArray();

//         $assign = Assign::with('documents')->findOrFail($assign->id);
// $assignedDocuments = $assign->documents->pluck('id')->toArray();


//         return view('assign.edit', compact('assign', 'users', 'documents', 'assignedDocuments'));
//     }


public function edit(Assign $assign)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $users = User::all();
    $documents = Document::all();

    // Get the assigned document IDs
    $assignedDocuments = Assign::where('user_id', $assign->user_id)->pluck('document_id')->toArray();

    return view('assign.edit', compact('assign', 'users', 'documents', 'assignedDocuments'));
}


    /**
     * Update assignments for a user.
     */
    public function update(Request $request, Assign $assign)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:documents,id',
        ]);

        // Update the assignment user_id
        $assign->update([
            'user_id' => $request->user_id,
        ]);

        // Delete old assignments related to this user
        Assign::where('user_id', $assign->user_id)->where('id', '!=', $assign->id)->delete();

        // Create new assignments for the user
        foreach ($request->document_ids as $document_id) {
            Assign::firstOrCreate([
                'user_id' => $request->user_id,
                'document_id' => $document_id,
            ]);
        }

        return redirect()->route('assign.index')->with('success', 'Assignments updated successfully!');
    }


    /**
     * Remove an assignment.
     */
    public function destroy(Assign $assign)
    {
        $assign->delete();

        session()->flash('success', 'Assignment deleted successfully!');
        return redirect()->route('assign.index');
    }
}
