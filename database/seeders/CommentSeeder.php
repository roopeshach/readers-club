<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use Illuminate\Support\Facades\File;

class CommentSeeder extends Seeder
{
    public function run()
    {
        if (File::exists(database_path('seeders/json/comments.json'))) {
            $comments = json_decode(File::get(database_path('seeders/json/comments.json')), true);
            foreach ($comments as $comment) {
                Comment::create($comment);
            }
        } else {
            Comment::factory()->count(50)->create();
        }
    }
}
