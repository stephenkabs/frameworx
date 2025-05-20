<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Path to the CSV file
        $csvFile = base_path('database/seeders/files.csv');

        // Open the CSV file
        if (!file_exists($csvFile) || !is_readable($csvFile)) {
            throw new \Exception("CSV file not found or not readable at $csvFile");
        }

        // Read and parse the CSV file
        $data = array_map('str_getcsv', file($csvFile));

        // Extract the header row
        $header = array_shift($data);

        // Insert each row into the 'permissions' table
        foreach ($data as $row) {
            $row = array_combine($header, $row);

            DB::table('permissions')->updateOrInsert(
                ['id' => $row['id']], // Ensures no duplicate entries
                [
                    'name' => $row['name'],
                    'guard_name' => $row['guard_name'],
                    'created_at' => Carbon::parse($row['created_at']),
                    'updated_at' => Carbon::parse($row['updated_at']),
                ]
            );
        }
    }
}
