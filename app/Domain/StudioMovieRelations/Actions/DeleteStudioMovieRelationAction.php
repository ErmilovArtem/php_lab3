<?php

namespace App\Domain\StudioMovieRelations\Actions;


use App\Models\StudioMovie;

class DeleteStudioMovieRelationAction
{
    public function execute(int $studioMovieId): void
    {
        $studio = StudioMovie::findOrFail($studioMovieId);
        $studio->delete();
    }
}
