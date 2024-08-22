<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'book_title' => $this->faker->sentence,
            'book_code' => $this->faker->unique()->isbn13,
            'author_id' => Author::factory(),
            'category_id' => BookCategory::factory(),
            'owner_id' => User::factory(),
            'cover_image_path' => $this->faker->imageUrl(640, 480, 'books', true, 'Faker'),
            'views_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
