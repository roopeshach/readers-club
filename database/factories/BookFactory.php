<?php

// database/factories/BookFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'isbn' => $this->faker->isbn13,
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'edition' => $this->faker->randomDigitNotNull,
            'cover_art' => $this->faker->imageUrl(),
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
