<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('user')->latest()->get();
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documents = Document::all();
        return view('comments.create',compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'signature' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'signature_pad' => 'nullable|string',
        ]);

        $signaturePath = null;

        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('signatures', 'public');
        }

        Comment::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'document_id' => $request->document_id,
            'signature' => $signaturePath,
            'signature_pad' => $request->signature_pad,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string',
            'signature' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'signature_pad' => 'nullable|string',
        ]);

        if ($request->hasFile('signature')) {
            // Delete old signature if exists
            if ($comment->signature) {
                Storage::disk('public')->delete($comment->signature);
            }
            $comment->signature = $request->file('signature')->store('signatures', 'public');
        }

        $comment->update([
            'comment' => $request->comment,
            'signature_pad' => $request->signature_pad,
            'document_id' => $request->document_id,
        ]);

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($comment->signature) {
            Storage::disk('public')->delete($comment->signature);
        }

        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully!');
    }
}
