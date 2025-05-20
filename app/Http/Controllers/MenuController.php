<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $menu = Menu::all();
        return view('menu.index', compact('profileData', 'menu'));
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
        $menuNames = Menu::all();
        return view('menu.create', compact('profileData','menuNames'));
    }


    public function create_sub()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $menu = Menu::all();
        return view('menu.create_sub', compact('profileData','menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $menu = new Menu();
        $menu->menu_name = $request->input('menu_name');
        $menu->sub_name = $request->input('sub_name');
        $menu->link = $request->input('link');
        $menu->type = $request->input('type');

        // Generate a unique slug
        $slug = Str::slug($request->input('menu_name','sub_name'));
        $originalSlug = $slug;
        $counter = 1;

        while (Menu::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $menu->slug = $slug;
        $menu->user_id = $user->id;
        $menu->save();

        session()->flash('success', 'Menu created successfully!');
        return redirect('menu');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('menu.show', compact('profileData', 'menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $profileData = Auth::user();
        return view('menu.edit', compact('profileData', 'menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'link' => 'required|url',
            'type' => 'required|string',
        ]);

        $menu->update($request->all());

        session()->flash('success', 'Menu updated successfully!');
        return redirect()->route('menu.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        session()->flash('success', 'Menu deleted successfully!');
        return redirect('menu');
    }
}
