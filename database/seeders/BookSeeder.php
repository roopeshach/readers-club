<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $dataFile = database_path('data.json');

        if (File::exists($dataFile)) {
            $data = json_decode(File::get($dataFile), true);
            $books = $data['books'];

            foreach ($books as $bookData) {
                $author = Author::firstOrCreate(['name' => $bookData['author']]);
                $category = Category::firstOrCreate(['name' => $bookData['category']]);
                $user = User::where('email', $bookData['user_email'])->first();

                if ($user) {
                    Book::updateOrCreate(
                        ['isbn' => $bookData['isbn']],
                        [
                            'title' => $bookData['title'],
                            'isbn' => $bookData['isbn'],
                            'publisher' => $bookData['publisher'],
                            'edition' => $bookData['edition'],
                            'category_id' => $category->id,
                            'author_id' => $author->id,
                            'user_id' => $user->id,
                            'cover_art' => $bookData['cover_art'],
                            'views' => $bookData['views']
                        ]
                    );
                }
            }
        } else {
            // Generate 50 books using the factory
            // Book::factory()->count(0)->create();
        }
    }
}
