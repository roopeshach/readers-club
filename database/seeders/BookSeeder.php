<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Publisher;
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
                // Find the category
                $category = Category::find($bookData['genre_id']);
                
                // Find the user (owner)
                $owner = User::find($bookData['owner_id']);
                
                // Find the publisher
                $publisher = Publisher::find($bookData['publisher_id']);
                
                if ($category && $owner && $publisher) {
                    Book::updateOrCreate(
                        ['book_code' => $bookData['book_code']],
                        [
                            'book_name' => $bookData['book_name'],
                            'book_code' => $bookData['book_code'],
                            'publisher_id' => $publisher->id,
                            'release_version' => $bookData['release_version'],
                            'genre_id' => $category->id,
                            'owner_id' => $owner->id,
                            'image_path' => $bookData['image_path'],
                            'view_count' => $bookData['view_count'],
                        ]
                    );
                }
            }
        } else {
            Book::factory()->count(50)->create();
        }
    }
}
