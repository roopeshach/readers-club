<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('data/categories.json');
        if (File::exists($jsonPath)) {
            $categories = json_decode(File::get($jsonPath), true);
            foreach ($categories as $categoryData) {
                Category::updateOrCreate(
                    ['genre_name' => $categoryData['genre_name']],
                    $categoryData
                );
            }
        } else {
            Category::factory()->count(10)->create();
        }
    }
}
