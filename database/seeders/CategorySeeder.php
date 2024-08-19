<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $dataFile = database_path('data.json');
        
        if (File::exists($dataFile)) {
            $data = json_decode(File::get($dataFile), true);
            $categories = $data['categories'];

            foreach ($categories as $categoryData) {
                Category::updateOrCreate(['name' => $categoryData['name']]);
            }
        } else {
            // Generate 10 categories using the factory
            // Category::factory()->count(0)->create();
        }
    }
}
