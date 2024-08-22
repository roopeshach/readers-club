<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\File;

class BookSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('seeders/data/books.json');

        if (File::exists($jsonPath)) {
            $books = json_decode(File::get($jsonPath), true);

            foreach ($books as $book) {
                Book::create([
                    'book_title' => $book['book_title'],
                    'book_code' => $book['book_code'],
                    'publisher_id' => $book['publisher_id'],
                    'category_id' => $book['category_id'],
                    'owner_id' => $book['owner_id'],
                    'views_count' => $book['views_count'],
                ]);
            }
        } else {
            // Fallback to Faker if JSON file doesn't exist
            Book::factory(20)->create();
        }
    }
}
