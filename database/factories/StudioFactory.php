<?php

namespace Database\Factories;

use App\Models\Studio;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudioFactory extends Factory
{
    protected $model = Studio::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'year_of_foundation' => $this->faker->dateTimeBetween('-20 year', '-1 month'),
            'active' => $this->faker->boolean(),
            'description' => $this->faker->sentence(),
        ];
    }
}
