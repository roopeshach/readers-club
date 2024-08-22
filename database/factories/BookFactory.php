<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'book_title' => $this->faker->sentence(3),
            'book_code' => $this->faker->unique()->isbn13,
            'publisher_id' => Publisher::factory(),
            'category_id' => BookCategory::factory(),
            'owner_id' => User::factory(),
            'views_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
