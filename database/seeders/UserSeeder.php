<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('seeders/data/users.json');

        if (File::exists($jsonPath)) {
            $users = json_decode(File::get($jsonPath), true);

            foreach ($users as $user) {
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                ]);
            }
        } else {
            // Fallback to Faker if JSON file doesn't exist
            User::factory(10)->create();
        }
    }
}
