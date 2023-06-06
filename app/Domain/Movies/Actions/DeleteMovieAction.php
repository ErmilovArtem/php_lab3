<?php

namespace App\Domain\Movies\Actions;

use App\Models\Movie;
use App\Models\Studio;

class DeleteMovieAction
{
    public function execute(int $movieId): void
    {
        $studio = Movie::findOrFail($movieId);
        $studio->delete();
    }
}
