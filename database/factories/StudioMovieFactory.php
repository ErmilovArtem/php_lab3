<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\StudioMovie;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudioMovieFactory extends Factory
{
    protected $model = StudioMovie::class;

    public function definition(): array
    {
        $countStudio = Studio::query()->count();
        $countMovie = Movie::query()->count();
        return [
            'movie_id' => $countStudio ? Studio::query()->inRandomOrder()->first()->id : 0,
            'studio_id' => $countMovie ? Studio::query()->inRandomOrder()->first()->id : 0
        ];
    }
}
