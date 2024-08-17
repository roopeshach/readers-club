<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'book_reference' => Book::factory(),
            'commenter_id' => User::factory(),
            'comment_text' => $this->faker->paragraph,
        ];
    }
}

