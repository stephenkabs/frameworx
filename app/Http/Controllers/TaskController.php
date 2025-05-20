<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Task;
use App\Models\Category;
use App\Models\Client;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class TaskController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view task',['only'=> ['index','show']]);
    //    $this->middleware('permission:create task',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit task',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete task',['only'=> ['destroy']]);

    // }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }

        $id = Auth::id();
        $profileData = User::find($id);
        $tasks = Task::where('user_id', $id)->latest()->get();
        $clients = Client::where('user_id', $id)->latest()->get();
        $quotation = Quotation::where('user_id', $id)->get();
        $employee = Worker::where('user_id', $id)->get();
        $categories = Category::where('user_id', $id)->get();
        

        return view('tasks.index', compact('tasks', 'quotation', 'employee', 'categories', 'profileData','clients'));
    }


    public function view()
    {
        return view('tasks.view'); // Blade view for showing tasks
    }

    public function addTask(Request $request)
    {
        $request->validate([
            'task' => 'required|string'
        ]);

        $task = $request->input('task');

        $pythonPath = env('PYTHON_PATH', 'python3');
        $scriptPath = base_path('scripts/tasks.py');

        $process = new Process([$pythonPath, $scriptPath, 'add', $task]);
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json(['error' => 'Failed to add task', 'output' => $process->getErrorOutput()], 500);
        }

        return response()->json(json_decode($process->getOutput(), true));
    }

    public function getTasks()
    {
        $pythonPath = env('PYTHON_PATH', 'python3');
        $scriptPath = base_path('scripts/tasks.py');

        $process = new Process([$pythonPath, $scriptPath, 'get']);
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json(['error' => 'Failed to get tasks', 'output' => $process->getErrorOutput()], 500);
        }

        return response()->json(json_decode($process->getOutput(), true));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Render the task creation form
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $employee = Worker::all();
        $categories = Category::where('user_id','=',$id)->get();
        $quotation = Quotation::where('user_id','=',$id)->get();
        $quotations = Quotation::where('user_id','=',$id)->get();
        $clients = Client::where('user_id','=',$id)->get();
        return view('tasks.create', compact('profileData','categories','employee','quotation','quotations','clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'priority' => 'nullable|in:low,medium,high,urgent',
        //     'start_date' => 'nullable|date',
        //     'end_date' => 'nullable|date|after_or_equal:start_date',
        //     'worker_id' => 'nullable|integer',
        //     'category_id' => 'nullable|integer',
        //     'status' => 'nullable|in:pending,in-progress,completed,on-hold,canceled',
        // ]);

        // Create and save the task
        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'worker_id' => $request->worker_id,
            'category_id' => $request->category_id,
            'quotation_id' => $request->quotation_id,
            'client_id' => $request->client_id,
            'status' => $request->status ?? 'pending',
            'slug' => Str::slug($request->title) . '-' . uniqid(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Ensure the task belongs to the logged-in user
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Ensure the task belongs to the logged-in user
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $employee = Worker::where('user_id', Auth::id());
        $categories = Category::where('user_id', Auth::id());
        $quotations = Quotation::where('user_id', Auth::id());
        $clients = Client::where('user_id', Auth::id());
        return view('tasks.edit', compact('task','employee','categories','quotations','clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Ensure the task belongs to the logged-in user
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate request data
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'priority' => 'nullable|in:low,medium,high,urgent',
        //     'start_date' => 'nullable|date',
        //     'end_date' => 'nullable|date|after_or_equal:start_date',
        //     'worker_id' => 'nullable|integer',
        //     'category_id' => 'nullable|integer',
        //     'status' => 'nullable|in:pending,in-progress,completed,on-hold,canceled',
        // ]);

        // Update the task
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'worker_id' => $request->worker_id,
            'category_id' => $request->category_id,
            'client_id' => $request->client_id,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Ensure the task belongs to the logged-in user
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
