<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition()
    {
        return [
            'author_name' => $this->faker->name,
            'author_bio' => $this->faker->paragraph,
        ];
    }
}
