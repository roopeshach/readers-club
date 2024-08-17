<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BookSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('data/books.json');
        if (File::exists($jsonPath)) {
            $books = json_decode(File::get($jsonPath), true);
            foreach ($books as $bookData) {
                Book::updateOrCreate(
                    ['book_code' => $bookData['book_code']],
                    $bookData
                );
            }
        } else {
            Book::factory()->count(50)->create();
        }
    }
}
