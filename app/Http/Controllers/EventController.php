<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $event = Event::all();

        $agent = new Agent();
        if ($agent->isMobile()) {
            // Load a separate view for mobile devices
            return view ('event.mobile_index', compact('profileData','event'));
        }

        return view ('event.index', compact('profileData','event'));

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

        return view ('event.create', compact('profileData',));
    }

    /**
     * Store a newly created resource in storage.
     */


     public function store(Request $request)
     {
         $user = auth()->user();
         $profileImage = null;

         if ($image = $request->file('image')) {
             $destinationPath = 'events';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
         }

         // Validate input
        //  $request->validate([
        //      'name' => 'required|string|max:255',
        //      'organizer_name' => 'required|string|max:255',
        //      'number' => 'required|string|max:20',
        //      'email' => 'required|email',
        //      'start_time' => 'required',
        //      'end_time' => 'required',
        //      'date' => 'required|date',
        //      'location' => 'required|string|max:255',
        //      'description' => 'required|string',
        //      'tickets' => 'nullable|array',
        //      'tickets.*.type' => 'required_with:tickets|string',
        //      'tickets.*.price' => 'required_with:tickets|numeric',
        //      'tickets.*.quantity' => 'required_with:tickets|integer',
        //  ]);

         // Create event
         $event = new Event();
         $event->name = $request->input('name');
         $event->organizer_name = $request->input('organizer_name');
         $event->number = $request->input('number');
         $event->email = $request->input('email');
         $event->price = $request->input('price');
         $event->start_time = $request->input('start_time');
         $event->end_time = $request->input('end_time');
         $event->date = $request->input('date');
         $event->location = $request->input('location');
         $event->available_tickets = $request->input('available_tickets');
         $event->slug = Str::slug($request->name);
         $event->mobile_money_number = $request->input('mobile_money_number');
         $event->mobile_money_name = $request->input('mobile_money_name');
         $event->mobile_money_number_two = $request->input('mobile_money_number_two');
         $event->mobile_money_name_two = $request->input('mobile_money_name_two');
         $event->description = $request->input('description');
         $event->user_id = $user->id;

         if ($profileImage) {
             $event->image = $profileImage;
         }

         $event->save();

         // Create tickets
         $tickets = $request->input('tickets');
         if (is_array($tickets)) {
             foreach ($tickets as $ticket) {
                 Ticket::create([
                     'event_id' => $event->id,
                     'type' => $ticket['type'],
                     'price' => $ticket['price'],
                     'quantity' => $ticket['quantity'],
                 ]);
             }
         }

         return redirect('event')->with('success', 'Event and tickets created successfully!');
     }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        if (!Auth::check()) {
            return redirect()->route('register');  // Redirect to login if not authenticated
        }

        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = User::find($id);

            // Eager load tickets
            $event->load('tickets');

            return view('event.show', compact('profileData', 'event'));
        }
    }

    public function public_show(Event $event)
{

    $similarEvent = Event::where('id', '!=', $event->id)
    ->inRandomOrder() // Random selection
    ->take(50) // Limit to 3 similar ministries
    ->get();

    $agent = new Agent();
    if ($agent->isMobile()) {
        // Load a separate view for mobile devices
        return view ('event.mobile_public', compact('similarEvent','event'));
    }

    // Return the public_show view with the update and signs data
    return view('event.public_show', compact('event','similarEvent'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view ('event.edit', compact('profileData','event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'events';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $event->update($input);
        return redirect('event')->with('success', 'Event Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect('event')->with('success', 'Event deleted successfully!');
    }
}
