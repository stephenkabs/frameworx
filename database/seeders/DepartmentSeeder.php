<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of department names
        $departments = [
            'Human Resources',
            'Finance',
            'Information Technology',
            'Marketing',
            'Sales',
            'Customer Support',
            'Operations',
            'Research and Development',
            'Procurement',
            'Quality Assurance',
            'Legal',
            'Public Relations',
            'Administration',
            'Logistics',
            'Training and Development',
        ];

        // Loop through each department and create a record
        foreach ($departments as $department) {
            Department::create([
                'name' => $department,
                'user_id' => 1, // Replace with the desired user ID
                'slug' => Str::slug($department . '-' . Str::random(5)), // Generate unique slug
            ]);
        }
    }
}
