<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
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


        $this->call([
            CategorySeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            CommentSeeder::class,
            UserSeeder::class,
        ]);
    }
}
