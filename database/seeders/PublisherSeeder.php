<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;
use Illuminate\Support\Facades\File;

class PublisherSeeder extends Seeder
{
    public function run()
    {
        // Check if the publishers.json file exists
        if (File::exists(database_path('data/publishers.json'))) {
            // Get the data from the JSON file
            $data = json_decode(File::get(database_path('data/publishers.json')), true);

            // Loop through each publisher and create a record in the database
            foreach ($data['publishers'] as $publisherData) {
                Publisher::updateOrCreate(
                    ['name' => $publisherData['name']],
                    ['location' => $publisherData['location']]
                );
            }
        } else {
            // Fallback to using Faker if the file does not exist
            Publisher::factory()->count(10)->create();
        }
    }
}
