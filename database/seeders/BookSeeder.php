<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\File;

class BookSeeder extends Seeder
{
    public function run()
    {
        if (File::exists(database_path('seeders/json/books.json'))) {
            $books = json_decode(File::get(database_path('seeders/json/books.json')), true);
            foreach ($books as $book) {
                Book::create($book);
            }
        } else {
            Book::factory()->count(20)->create();
        }
    }
}
