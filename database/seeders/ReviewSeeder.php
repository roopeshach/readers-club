<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Book;



class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $dataFile = database_path('data.json');
        
        if (File::exists($dataFile)) {
            $data = json_decode(File::get($dataFile), true);
            $reviews = $data['reviews'];
            foreach ($reviews as $reviewData) {
                $user = User::where('email', $reviewData['user_email'])->first();
                $book = Book::where('isbn', $reviewData['book_isbn'])->first();

                if ($user && $book) {
                    Review::updateOrCreate(
                        ['user_id' => $user->id, 'book_id' => $book->id],
                        [
                            'rating' => $reviewData['rating'],
                            'content' => $reviewData['content']
                        ]
                    );
                }
            }

        } else {
            // Generate 10 categories using the factory
            Review::factory()->count(100)->create();
        }
       
    }
}
