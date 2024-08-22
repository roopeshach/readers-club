<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Facades\File;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        if (File::exists(database_path('seeders/json/authors.json'))) {
            $authors = json_decode(File::get(database_path('seeders/json/authors.json')), true);
            foreach ($authors as $author) {
                Author::create($author);
            }
        } else {
            Author::factory()->count(10)->create();
        }
    }
}
