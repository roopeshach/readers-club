<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call individual seeders
        $this->call([
            UserSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,
            CategorySeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
