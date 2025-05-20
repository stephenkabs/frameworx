<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Worker;

class AttendanceController extends Controller
{
    public function index()
    {
        $id=Auth::user()->id;
        $workers = Worker::with('attendances')->where('user_id','=',$id)->get();
        return view('attendance.index', compact('workers'));
    }



    // public function store(Request $request)
    // {
    //     $date = $request->date ?? now()->toDateString();

    //     foreach ($request->all() as $key => $value) {
    //         if (strpos($key, 'clock_in') === 0) {
    //             $worker_id = array_key_first($value);
    //             Attendance::updateOrCreate(
    //                 ['worker_id' => $worker_id, 'date' => $date],
    //                 ['clock_in' => now()->toTimeString()]
    //             );
    //         }

    //         if (strpos($key, 'clock_out') === 0) {
    //             $worker_id = array_key_first($value);
    //             $attendance = Attendance::where('worker_id', $worker_id)->where('date', $date)->first();

    //             if ($attendance) {
    //                 $attendance->update([
    //                     'clock_out' => now()->toTimeString()
    //                 ]);
    //             }
    //         }
    //     }

    //     return back()->with('success', 'Attendance updated');
    // }

    public function store(Request $request)
{
    $date = $request->date ?? now()->toDateString();

    foreach ($request->all() as $key => $value) {
        if (strpos($key, 'clock_in') === 0) {
            $worker_id = array_key_first($value);

            Attendance::updateOrCreate(
                ['worker_id' => $worker_id, 'date' => $date],
                [
                    'clock_in' => now()->toTimeString(),
                    'user_id' => auth()->id(),
                ]
            );
        }

        if (strpos($key, 'clock_out') === 0) {
            $worker_id = array_key_first($value);
            $attendance = Attendance::where('worker_id', $worker_id)->where('date', $date)->first();

            if ($attendance) {
                $attendance->update([
                    'clock_out' => now()->toTimeString()
                ]);
            }
        }
    }

    return back()->with('success', 'Attendance updated');
}



}
