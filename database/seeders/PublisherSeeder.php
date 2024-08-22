<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;
use Illuminate\Support\Facades\File;

class PublisherSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('seeders/data/publishers.json');

        if (File::exists($jsonPath)) {
            $publishers = json_decode(File::get($jsonPath), true);

            foreach ($publishers as $publisher) {
                Publisher::create([
                    'publisher_name' => $publisher['publisher_name'],
                    'publisher_location' => $publisher['publisher_location'],
                ]);
            }
        } else {
            // Fallback to Faker if JSON file doesn't exist
            Publisher::factory(5)->create();
        }
    }
}
