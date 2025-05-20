<?php

namespace App\Http\Controllers;

use App\Models\Garnish;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GarnishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garnish = Garnish::with('user', 'document')->latest()->get();
        return view('garnish.index', compact('garnish'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documents = Document::all();
        return view('garnish.create', compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'document_id' => 'required|exists:documents,id',
            'amount' => 'required|numeric',
            'signature' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'signature_pad' => 'nullable|string',
        ]);

        $signaturePath = $request->hasFile('signature')
            ? $request->file('signature')->store('signatures', 'public')
            : null;

            Garnish::create([
                'user_id' => Auth::id(),
                'comment' => $request->comment,
                'slug' => Str::slug($request->comment . '-' . uniqid()), // Generate slug
                'document_id' => $request->document_id,
                'amount' => $request->amount,
                'signature' => $signaturePath,
                'signature_pad' => $request->signature_pad,
            ]);

        return redirect()->route('garnish.index')->with('success', 'Garnish created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Garnish $garnish)
    {
        return view('garnish.show', compact('garnish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Garnish $garnish)
    {
        $documents = Document::all();
        return view('garnish.edit', compact('garnish', 'documents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Garnish $garnish)
    {
        $request->validate([
            'comment' => 'required|string',
            'document_id' => 'required|exists:documents,id',
            'amount' => 'required|numeric',
            'signature' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'signature_pad' => 'nullable|string',
        ]);

        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('signatures', 'public');
            $garnish->update(['signature' => $signaturePath]);
        }

        $garnish->update([
            'comment' => $request->comment,
            'slug' => Str::slug($request->comment . '-' . uniqid()), // Update slug
            'document_id' => $request->document_id,
            'amount' => $request->amount,
            'signature_pad' => $request->signature_pad,
        ]);

        return redirect()->route('garnish.index')->with('success', 'Garnish updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Garnish $garnish)
    {
        $garnish->delete();
        return redirect()->route('garnish.index')->with('success', 'Garnish deleted successfully!');
    }
}
