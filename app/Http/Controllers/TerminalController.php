<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerminalController extends Controller
{

    public function showForm()
    {
        return view('terminal.form');
    }
    public function runCommand(Request $request)
    {
        $command = $request->input('command');

        // Basic security: Allow only artisan commands
        if (!str_starts_with($command, 'artisan')) {
            return back()->with('error', 'Only artisan commands are allowed.');
        }

        // Execute the command
        $output = [];
        $returnVar = 0;

        exec('php ' . base_path('artisan') . ' ' . escapeshellcmd(str_replace('artisan ', '', $command)), $output, $returnVar);

        if ($returnVar !== 0) {
            return back()->with('error', implode("\n", $output));
        }

        return back()->with('success', implode("\n", $output));
    }
}
