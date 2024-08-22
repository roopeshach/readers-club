<?php

namespace Database\Factories;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublisherFactory extends Factory
{
    protected $model = Publisher::class;

    public function definition()
    {
        return [
            'publisher_name' => $this->faker->company,
            'publisher_location' => $this->faker->city,
        ];
    }
}
