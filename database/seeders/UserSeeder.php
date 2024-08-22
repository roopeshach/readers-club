<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        if (File::exists(database_path('seeders/json/users.json'))) {
            $users = json_decode(File::get(database_path('seeders/json/users.json')), true);
            foreach ($users as $user) {
                // Encrypt the password from the JSON file
                $user['password'] = Hash::make($user['password']);
                User::create($user);
            }
        } else {
            User::factory()->count(10)->create();
        }
    }
}
