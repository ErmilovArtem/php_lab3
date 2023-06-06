<?php

namespace App\Http\ApiV1\Modules\StudioMovieRelations\Queries;

use App\Models\StudioMovie;

use phpDocumentor\Reflection\Types\Boolean;

class StudioMovieRelationsQuery
{
    public function findOrFail(int $studioId): StudioMovie
    {
        $studio = StudioMovie::findOrFail($studioId);
        return $studio;
    }

    public function find(int $studioId): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|StudioMovie|array|null
    {
        $studio = StudioMovie::find($studioId);
        return $studio;
    }

    public function findAll(): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|StudioMovie|array|null
    {
        $studio = StudioMovie::all();
        return $studio;
    }

    public function allByOrder(string $param, bool $Desc = false): \Illuminate\Support\Collection
    {
        if(!$Desc)
            return StudioMovie::orderBy($param)->get();
        else
            return StudioMovie::orderBy($param, "desc")->get();
    }

    public function allByWhere(string $param, $operator): array|\Illuminate\Database\Eloquent\Collection
    {
        return StudioMovie::where($param, $operator)->get();

    }
}
