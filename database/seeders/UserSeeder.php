<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Check if the JSON file exists
        $jsonPath = database_path('data/users.json');
        if (File::exists($jsonPath)) {
            $users = json_decode(File::get($jsonPath), true);
            foreach ($users as $userData) {
                User::updateOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name' => $userData['name'],
                        'password' => Hash::make($userData['password']),
                        'role' => $userData['role'],
                    ]
                );
            }
        } else {
            // If no JSON file, create default users
            // User::create([
            //     'name' => 'admin_abc',
            //     'email' => 'admin@readers-club.com',
            //     'password' => Hash::make('superuser1234'),
            //     'role' => 'superadmin',
            // ]);

            // User::create([
            //     'name' => 'abc',
            //     'email' => 'abc@ulster.ac.uk',
            //     'password' => Hash::make('password1234'),
            //     'role' => 'user',
            // ]);

            // Generate additional users with Faker
            User::factory()->count(10)->create();
        }
    }
}
