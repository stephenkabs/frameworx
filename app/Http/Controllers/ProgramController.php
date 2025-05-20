<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('programs.index', [
            'programs' => Program::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a base slug from the title
        $baseSlug = Str::slug($request->input('title'));
        $slug = $baseSlug;
        $counter = 1;

        // Ensure uniqueness of slug
        while (Program::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Save the program
        $program = new Program();
        $program->title = $request->input('title');
        $program->slug = $slug;
        $program->description = $request->input('description');
        $program->user_id = Auth::id();
        $program->save();

        return redirect()->route('programs.index')->with('success', 'Program created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // If title has changed, regenerate slug
        if ($program->title !== $request->input('title')) {
            $baseSlug = Str::slug($request->input('title'));
            $slug = $baseSlug;
            $counter = 1;

            while (Program::where('slug', $slug)->where('id', '!=', $program->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $program->slug = $slug;
        }

        $program->title = $request->input('title');
        $program->description = $request->input('description');
        $program->save();

        return redirect()->route('programs.index')->with('success', 'Program updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')->with('success', 'Program deleted successfully!');
    }
}
