<?php

namespace App\Domain\Movies\Actions;

use App\Models\Movie;
use App\Models\Studio;

class CreateMovieAction
{
    public function execute(array $data): Movie
    {
        return Movie::create($data);
    }
}
