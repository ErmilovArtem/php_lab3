<?php

namespace Database\Factories;

use App\Models\Director;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        $count = Director::query()->count();
        return [
            'name' => $this->faker->unique()->sentence(),
            'description' => $this->faker->sentence(),
            'year' => $this->faker->dateTimeBetween('-20 year', '-1 month'),
            'genre' => $this->faker->unique()->word(),
            'image' => $this->faker->imageUrl(),
            'rating' => $this->faker->numberBetween(1, 10),
            'director_id' => $count ? Director::query()->inRandomOrder()->first()->id : 0,
        ];
    }
}
