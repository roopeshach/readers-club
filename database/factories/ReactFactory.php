<?php

namespace Database\Factories;

use App\Models\React;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactFactory extends Factory
{
    protected $model = React::class;

    public function definition()
    {
        return [
            'book_id' => Book::factory(),
            'react_user_id' => User::factory(),
            'reaction_type' => $this->faker->randomElement(['like', 'angry', 'sad', 'happy', 'love']),
        ];
    }
}
