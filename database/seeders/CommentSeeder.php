<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('data/comments.json');
        if (File::exists($jsonPath)) {
            $comments = json_decode(File::get($jsonPath), true);
            foreach ($comments as $commentData) {
                Comment::updateOrCreate(
                    ['comment_text' => $commentData['comment_text'], 'book_reference' => $commentData['book_reference']],
                    $commentData
                );
            }
        } else {
            Comment::factory()->count(100)->create();
        }
    }
}
