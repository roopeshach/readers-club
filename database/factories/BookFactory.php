<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'book_name' => $this->faker->sentence,
            'book_code' => $this->faker->isbn13,
            'published_by' => $this->faker->company,
            'release_version' => $this->faker->randomDigitNotNull,
            'genre_id' => Category::factory(),
            'owner_id' => User::factory(),
            'image_path' => $this->faker->imageUrl(),
            'view_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
