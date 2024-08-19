<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin_abc',
            'email' => 'admin@readers-club.com',
            'password' => Hash::make('superuser1234'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'abc',
            'email' => 'abc@ulster.ac.uk',
            'password' => Hash::make('password1234'),
            'role' => 'user',
        ]);
    }
}
