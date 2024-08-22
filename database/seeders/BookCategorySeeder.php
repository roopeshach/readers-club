<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookCategory;
use Illuminate\Support\Facades\File;

class BookCategorySeeder extends Seeder
{
    public function run()
    {
        if (File::exists(database_path('seeders/json/book_categories.json'))) {
            $categories = json_decode(File::get(database_path('seeders/json/book_categories.json')), true);
            foreach ($categories as $category) {
                BookCategory::create($category);
            }
        } else {
            BookCategory::factory()->count(5)->create();
        }
    }
}
