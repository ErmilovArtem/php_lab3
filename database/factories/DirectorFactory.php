<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Director>
 */
class DirectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'date_of_birth' => $this->faker->dateTimeBetween('-20 year', '-1 month'),
            'date_of_debute' => $this->faker->dateTimeBetween('-10 year', '-1 month'),
        ];
    }
}
