<?php

namespace App\Domain\StudioMovieRelations\Actions;

use App\Models\StudioMovie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PatchStudioMovieRelationAction
{
    public function execute(int $studioMovieId, array $fields): Builder|array|Collection|Model
    {
        $user = StudioMovie::findOrFail($studioMovieId);
        $user->update($fields);
        return $user;
    }
}
