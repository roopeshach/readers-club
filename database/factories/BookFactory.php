<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'isbn' => $this->faker->unique()->isbn13,
            'publisher' => $this->faker->company,
            'edition' => $this->faker->numberBetween(1, 10),
            'category_id' => Category::factory(),
            'author_id' => Author::factory(),
            'user_id' => User::factory(),
            'cover_art' => $this->faker->imageUrl(640, 480, 'books', true),
            'views' => $this->faker->numberBetween(0, 100),
        ];
    }
}

