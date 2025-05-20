<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Str;

class ExcelDataController extends Controller
{
    // public function store(Request $request)
    // {
    //     // Validate incoming request
    //     // $request->validate([
    //     //     '*.supplier_name' => 'required|string',
    //     //     '*.tpin' => 'required|string',
    //     //     '*.invoice_date' => 'required|date',
    //     //     '*.invoice_no' => 'required|string|unique:documents,invoice_no',
    //     //     '*.amount_nv' => 'required|numeric',
    //     //     '*.description' => 'nullable|string',
    //     // ]);

    //     try {
    //         // Loop through extracted data and insert into the 'documents' table
    //         foreach ($request->all() as $row) {
    //             Document::create([
    //                 'supplier_name' => $row['supplier_name'],
    //                 'tpin' => $row['tpin'],
    //                 'invoice_date' => $row['invoice_date'],
    //                 'invoice_no' => $row['invoice_no'],
    //                 'amount_nv' => $row['amount_nv'],
    //                 'description' => $row['description'] ?? null,
    //             ]);
    //         }

    //         return response()->json(['message' => 'Data stored successfully'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Failed to store data', 'details' => $e->getMessage()], 500);
    //     }
    // }


//     public function store(Request $request)
// {
//     // Validate incoming request
//     $request->validate([
//         '*.supplier_name' => 'required|string',
//         '*.tpin' => 'required|string',
//         '*.invoice_date' => 'required|date',
//         '*.invoice_no' => 'required|string|unique:documents,invoice_no',
//         '*.amount_nv' => 'required|numeric',
//         '*.description' => 'nullable|string',
//     ]);

//     try {
//         // Loop through extracted data and insert into the 'documents' table
//         foreach ($request->all() as $row) {
//             Document::create([
//                 'supplier_name' => $row['supplier_name'],
//                 'tpin' => $row['tpin'],
//                 'invoice_date' => $row['invoice_date'],
//                 'invoice_no' => $row['invoice_no'],
//                 'amount_nv' => $row['amount_nv'],
//                 'description' => $row['description'] ?? null,
//                 'user_id' => 1, // Default to user ID 1
//             ]);
//         }

//         return response()->json(['message' => 'Data stored successfully'], 200);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Failed to store data', 'details' => $e->getMessage()], 500);
//     }
// }



public function store(Request $request)
{
    // Validate incoming request
    // $request->validate([
    //     '*.supplier_name' => 'required|string',
    //     '*.tpin' => 'required|string',
    //     '*.invoice_date' => 'required|date',
    //     '*.invoice_no' => 'required|string|unique:documents,invoice_no',
    //     '*.amount_nv' => 'required|numeric',
    //     '*.description' => 'nullable|string',
    // ]);

    try {
        // Loop through extracted data and insert into the 'documents' table
        foreach ($request->all() as $row) {
            $slug = Str::slug($row['supplier_name']); // Generate initial slug

            // Ensure the slug is unique
            $count = 1;
            $originalSlug = $slug;
            while (Document::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            Document::create([
                'supplier_name' => $row['supplier_name'],
                'tpin' => $row['tpin'],
                'invoice_date' => $row['invoice_date'],
                'invoice_amount' => $row['invoice_amount'],
                'invoice_no' => $row['invoice_no'],
                'amount_nv' => $row['amount_nv'],
                'description' => $row['description'] ?? null,
                'user_id' => 1, // Default to user ID 1
                'slug' => $slug, // Save unique slug
            ]);
        }

        return response()->json(['message' => 'Data stored successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to store data', 'details' => $e->getMessage()], 500);
    }
}

// public function store(Request $request)
// {
//     $request->validate([
//         'data' => 'required|array|min:1',
//         'data.*.supplier_name' => 'required|string',
//         'data.*.tpin' => 'required|string',
//         'data.*.invoice_date' => 'required|date',
//         'data.*.invoice_no' => 'required|string|unique:documents,invoice_no',
//         'data.*.amount_nv' => 'required|numeric',
//         'data.*.invoice_amount' => 'required|numeric',
//         'data.*.description' => 'nullable|string',
//     ]);

//     try {
//         foreach ($request->input('data') as $row) {
//             $slug = Str::slug($row['supplier_name']);
//             $count = 1;
//             $originalSlug = $slug;
//             while (Document::where('slug', $slug)->exists()) {
//                 $slug = $originalSlug . '-' . $count;
//                 $count++;
//             }

//             Document::create([
//                 'supplier_name' => $row['supplier_name'],
//                 'tpin' => $row['tpin'],
//                 'invoice_date' => $row['invoice_date'],
//                 'invoice_amount' => $row['invoice_amount'],
//                 'invoice_no' => $row['invoice_no'],
//                 'amount_nv' => $row['amount_nv'],
//                 'description' => $row['description'] ?? null,
//                 'user_id' => $row['user_id'] ?? 1,
//                 'slug' => $slug,
//             ]);
//         }

//         return response()->json(['message' => 'Data stored successfully'], 200);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Failed to store data', 'details' => $e->getMessage()], 500);
//     }
// }


// public function store(Request $request)
// {
//     // $request->validate([
//     //     'data' => 'required|array|min:1',
//     //     'data.*.supplier_name' => 'required|string',
//     //     'data.*.tpin' => 'required|string',
//     //     'data.*.invoice_date' => 'required|date',
//     //     'data.*.invoice_no' => 'required|string|unique:documents,invoice_no',
//     //     'data.*.amount_nv' => 'required|numeric',
//     //     'data.*.invoice_amount' => 'required|numeric',
//     //     'data.*.description' => 'nullable|string',
//     // ]);

//     try {
//         foreach ($request->input('data') as $row) {
//             $slug = Str::slug($row['supplier_name']);
//             $count = 1;
//             $originalSlug = $slug;
//             while (Document::where('slug', $slug)->exists()) {
//                 $slug = $originalSlug . '-' . $count;
//                 $count++;
//             }

//             Document::create([
//                 'supplier_name' => $row['supplier_name'],
//                 'tpin' => $row['tpin'],
//                 'invoice_date' => $row['invoice_date'],
//                 'invoice_amount' => $row['invoice_amount'],
//                 'invoice_no' => $row['invoice_no'],
//                 'amount_nv' => $row['amount_nv'],
//                 'description' => $row['description'] ?? null,
//                 'user_id' => $row['user_id'] ?? 1,
//                 'slug' => $slug,
//             ]);
//         }

//         return response()->json(['message' => 'Data stored successfully'], 200);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Failed to store data', 'details' => $e->getMessage()], 500);
//     }
// }





}
