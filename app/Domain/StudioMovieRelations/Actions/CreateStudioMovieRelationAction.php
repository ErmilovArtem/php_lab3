<?php

namespace App\Domain\StudioMovieRelations\Actions;

use App\Models\StudioMovie;

class CreateStudioMovieRelationAction
{
    public function execute(array $data): StudioMovie
    {
        return StudioMovie::create($data);
    }
}
