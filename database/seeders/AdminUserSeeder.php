<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin'];

        foreach ($roles as $role) {
            // Create a new user for each role
            $user = User::create([
                'name' => ucfirst($role) . ' User',
                'email' => $role . '@gmail.com', // Role-based email with zra.org domain
                'password' => Hash::make('password'), // Adjust the password as needed
            ]);

            // Create the role if it doesn't exist
            $roleModel = Role::firstOrCreate(['name' => $role]);

            // Assign the role to the user
            $user->assignRole($roleModel);
        }
    }
}
