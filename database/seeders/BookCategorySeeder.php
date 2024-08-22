<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookCategory;
use Illuminate\Support\Facades\File;

class BookCategorySeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('seeders/data/book_categories.json');

        if (File::exists($jsonPath)) {
            $categories = json_decode(File::get($jsonPath), true);

            foreach ($categories as $category) {
                BookCategory::create([
                    'category_name' => $category['category_name'],
                ]);
            }
        } else {
            // Fallback to Faker if JSON file doesn't exist
            BookCategory::factory(5)->create();
        }
    }
}
