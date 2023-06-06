<?php

namespace App\Domain\Movies\Actions;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PatchMovieAction
{
    public function execute(int $movieId, array $fields): Builder|array|Collection|Model
    {
        $user = Movie::findOrFail($movieId);
        $user->update($fields);
        return $user;
    }
}
