<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Facades\File;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $dataFile = database_path('data/data.json');
        
        if (File::exists($dataFile)) {
            $data = json_decode(File::get($dataFile), true);
            $authors = $data['authors'];

            foreach ($authors as $authorData) {
                Author::updateOrCreate(
                    ['name' => $authorData['name']],
                    ['biography' => $authorData['biography']]
                
                );
            }
        } else {
            // Generate 10 authors using the factory
            Author::factory()->count(10)->create();
        }
    }
}
