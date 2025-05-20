<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PdfMergeController extends Controller
{
    public function showForm()
    {
        return view('pdf.merge');
    }



    public function mergePdfs(Request $request)
{
    $request->validate([
        'pdf_files' => 'required|array|min:2', // At least two PDFs required
        'pdf_files.*' => 'mimes:pdf|max:20480', // Max 20MB per file
    ]);

    $uploadedFiles = [];
    $storagePath = storage_path('app/private/pdfs');

    // Store uploaded PDFs and collect file paths
    foreach ($request->file('pdf_files') as $file) {
        $filePath = $file->store('private/pdfs', 'local');
        $uploadedFiles[] = storage_path('app/' . $filePath);
    }

    if (count($uploadedFiles) < 2) {
        return response()->json(['error' => 'At least two PDFs are required for merging.'], 400);
    }

    // Define the merged output file path
    $mergedFileName = 'merged_' . time() . '.pdf';
    $mergedFilePath = $storagePath . '/' . $mergedFileName;

    // Run Python script to merge PDFs
    $pythonPath = env('PYTHON_PATH', '/Library/Frameworks/Python.framework/Versions/3.12/bin/python3');
    $scriptPath = base_path('scripts/merge_pdfs.py');

    $process = new Process(array_merge([$pythonPath, $scriptPath], $uploadedFiles, [$mergedFilePath]));
    $process->run();

    if (!$process->isSuccessful()) {
        return response()->json(['error' => 'PDF merging failed: ' . $process->getErrorOutput()], 500);
    }

    // Delete uploaded PDFs after merging
    foreach ($uploadedFiles as $file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }

    // Return the merged file as a download response
    return response()->download($mergedFilePath)->deleteFileAfterSend(true);
}

}
