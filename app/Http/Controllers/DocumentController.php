<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Assign;
use App\Models\Comment;
use App\Models\Garnish;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function __construct()
    //  {
    //     $this->middleware(['permission:view document'])->only(['index', 'show']);
    //     $this->middleware(['permission:create document'])->only(['create', 'store']);
    //     $this->middleware(['permission:edit document'])->only(['edit', 'update']);
    //     $this->middleware(['permission:delete document'])->only(['destroy']);

    //  }



    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        $documents = Document::with('user')->get(); // Get all documents
        $users = User::all(); // Get all users
        $unassignedDocuments = Document::whereNull('user_id')->get(); // Only get documents with no user_id

        return view('documents.index', compact('user', 'documents', 'users', 'unassignedDocuments'));
    }


public function myDocuments()
{
    // Get the logged-in user's ID
    $userId = auth()->id();

    // Fetch documents assigned to the logged-in user through the Assign model
    $documents = Assign::where('user_id', $userId)
        ->with('document') // Assuming 'document' relationship is defined in Assign model
        ->get()
        ->pluck('document'); // Get only the related documents

    return view('documents.my_documents', compact('documents'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id=Auth::user()->id;
        $user = User::find($id);
        $document = Document::all();
        return view ('documents.create', compact('document','user'));
    }

    public function assignDocumentsToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:documents,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $documents = Document::whereIn('id', $request->document_ids)->get();

        foreach ($documents as $document) {
            $document->user_id = $user->id; // Assign document to another user
            $document->save();
        }

        return redirect()->back()->with('success', 'Documents assigned successfully');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $user = auth()->user();

    // Validate incoming request data
    $request->validate([
        'supplier_name' => 'required|string|max:255|unique:documents,supplier_name',
        'currency' => 'nullable|string|max:500',
        'tpin' => 'required|string|max:20|unique:documents,tpin',
        'invoice_date' => 'required|date',
        'invoice_no' => 'required|string|max:50|unique:documents,invoice_no',
        'invoice_amount' => 'required|numeric',
        'vat_withheld' => 'nullable|numeric',
        'amount_nv' => 'nullable|numeric',
        'description' => 'nullable|string|max:500',
    ]);


    // Generate a unique slug
    $slug = Str::slug($request->supplier_name);
    $counter = 1;

    // Check if the slug already exists and modify it if necessary
    while (Document::where('slug', $slug)->exists()) {
        $slug = Str::slug($request->supplier_name) . '-' . $counter;
        $counter++;
    }

    // Create a new document record
    $post = new Document();
    $post->supplier_name = $request->input('supplier_name');
    // $post->folder_id = $request->input('folder_id');
    $post->tpin = $request->input('tpin');
    $post->invoice_date = $request->input('invoice_date');
    $post->invoice_no = $request->input('invoice_no');
    $post->invoice_amount = $request->input('invoice_amount');
    $post->vat_withheld = $request->input('vat_withheld');
    $post->amount_nv = $request->input('amount_nv');
    $post->description = $request->input('description');
    $post->currency = $request->input('currency');
    $post->status = $request->input('status');
    $post->slug = $slug; // Use the unique slug
    $post->user_id = $user->id;
    $post->save();

    return redirect('documents')->with('success', 'Submitted successfully');
}

    /**
     * Display the specified resource.
     */
    // public function show(Document $document)
    // {
    //     $id = Auth::user()->id;
    //     $user = User::find($id);

    //     // Fetch only comments related to the given document
    //     $comments = Comment::with('user')
    //         ->where('document_id', $document->id)
    //         ->latest()
    //         ->get();

    //     return view('documents.show', compact('user', 'document', 'comments'));
    // }

//     public function show(Document $document)
// {
//     $user = Auth::user();

//     // Fetch only the logged-in user's comments related to this document
//     $userComments = Comment::where('document_id', $document->id)
//         ->where('user_id', $user->id)
//         ->latest()
//         ->get();

//     return view('documents.show', compact('user', 'document', 'userComments'));
// }

public function show(Document $document)
{
    $user = Auth::user();

    // Fetch all comments related to this document (from all users)
    $userComments = Comment::with('user')->where('document_id', $document->id)->latest()->get();
    $garnish = Garnish::all();
    // Check if the logged-in user has commented
    $userHasCommented = $userComments->where('user_id', $user->id)->count() > 0;

    return view('documents.show', compact('user', 'document', 'userComments', 'userHasCommented','garnish'));
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        $id=Auth::user()->id;
        $user = User::find($id);
        return view ('documents.edit', compact('user','document'));
    }

//     public function assignDocumentsToUser(Request $request)
// {
//     $request->validate([
//         'user_id' => 'required|exists:users,id',
//         'document_ids' => 'required|array',
//         'document_ids.*' => 'exists:documents,id',
//     ]);

//     $user = User::findOrFail($request->user_id);
//     $documents = Document::whereIn('id', $request->document_ids)->get();

//     foreach ($documents as $document) {
//         $document->user_id = $user->id;
//         $document->save();
//     }

//     return redirect()->back()->with('success', 'Documents assigned successfully');
// }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $input = $request->all();


        $document->update($input);

        return redirect()->route('documents.index')->with('success','Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->back()->with('success', 'Document deleted successfully');
    }

    public function exportToPDF($slug)
    {
        $document = Document::where('slug', $slug)->firstOrFail();
        $pdf = Pdf::loadView('pdf.document', compact('document'));
        return $pdf->download($document->title . '.pdf');
    }
}
