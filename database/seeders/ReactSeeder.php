<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\React;
use Illuminate\Support\Facades\File;

class ReactSeeder extends Seeder
{
    public function run()
    {
        if (File::exists(database_path('seeders/json/reacts.json'))) {
            $reacts = json_decode(File::get(database_path('seeders/json/reacts.json')), true);
            foreach ($reacts as $react) {
                React::create($react);
            }
        } else {
            React::factory()->count(30)->create();
        }
    }
}
