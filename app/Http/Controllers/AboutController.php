<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

            $id=Auth::user()->id;
            $profileData = User::find($id);
            $about = About::where('user_id','=',$id)->get();
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
        $user = auth()->user();
        if ($image = $request->file('image')) {
            $destinationPath = 'about';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $post['image'] = "$profileImage";
        }
        if ($file = $request->file('file')) {
            $destinationPath = 'about';
            $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileFile);
            $post['image'] = "$profileFile";
        }

        $user = auth()->user();
        $post = new About();
        $post->sub_title = $request->input('sub_title');
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->cs = $request->input('cs');
        $post->cs_figure = $request->input('cs_figure');
        $post->pc = $request->input('pc');
        $post->pc_figure = $request->input('pc_figure');
        $post->status = $request->input('status');
        $post->image = $profileImage;
        $post->file = $profileFile;
        $post->user_id = $user->id;
        $post->save();

        return redirect('about_us')->with('success', 'Goal created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('about_us.show', compact('profileData','about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('about_us.edit', compact('profileData','about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'about';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";

        }else{
            unset($input['image']);


        }
        if ($file = $request->file('file')) {
            $destinationPath = 'about';
            $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileFile);
            $input['image'] = "$profileFile";
        }
        else{
            unset($input['image']);
        }

        $about->update($input);

        return redirect()->route('about_us.index')->with('message','Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about->delete();

        return redirect()->route('setting.index')->with('Message','Expense deleted successfully');
    }
}
