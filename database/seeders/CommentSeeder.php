<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use Illuminate\Support\Facades\File;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('seeders/data/comments.json');

        if (File::exists($jsonPath)) {
            $comments = json_decode(File::get($jsonPath), true);

            foreach ($comments as $comment) {
                Comment::create([
                    'book_id' => $comment['book_id'],
                    'comment_user_id' => $comment['comment_user_id'],
                    'comment_content' => $comment['comment_content'],
                ]);
            }
        } else {
            // Fallback to Faker if JSON file doesn't exist
            Comment::factory(50)->create();
        }
    }
}
