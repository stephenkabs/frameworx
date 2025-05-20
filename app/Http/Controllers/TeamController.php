<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $about = Team::where('user_id','=',$id)->get();
        return view ('about_us.index', compact('profileData','about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('about_us.create', compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('team.show', compact('profileData','team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('team.edit', compact('profileData','team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
