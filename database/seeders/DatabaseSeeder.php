<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\BannerCategory;
use App\Models\Director;
use App\Models\Movie;
use App\Models\Studio;
use App\Models\StudioMovie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Director::factory(100)->create();
        Studio::factory(100)->create();
        Movie::factory(100)->create();
        StudioMovie::factory(100)->create();
    }
}
