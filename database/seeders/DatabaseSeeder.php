<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            // Admin 
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'status' => '1',
        ]);


        \App\Models\User::factory()->create([
            // Instructor  
            'name' => 'Instructor',
            'username' => 'instructor',
            'email' => 'instructor@gmail.com',
            'role' => 'instructor',
            'status' => '1',
        ]);
        // User Data 
        \App\Models\User::factory()->create([
            // Instructor  
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'status' => '1',
        ]);
    }
}
