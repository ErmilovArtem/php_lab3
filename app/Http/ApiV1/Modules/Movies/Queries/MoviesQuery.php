<?php

namespace App\Http\ApiV1\Modules\Movies\Queries;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MoviesQuery
{
    public function findOrFail(int $movieId): Movie
    {
        $movie = Movie::findOrFail($movieId);
        return $movie;
    }

    public function find(int $movieId): Model|Collection|Movie|array|null
    {
        $movie = Movie::find($movieId);
        return $movie;
    }

    public function findAll(): Model|Collection|Movie|array|null
    {
        $movie = Movie::all();
        return $movie;
    }

    public function allByOrder(string $param, bool $Desc = false): \Illuminate\Support\Collection
    {
        if (!$Desc)
            return Movie::orderBy($param)->get();
        else
            return Movie::orderBy($param, "desc")->get();
    }

    public function allByWhere(string $param, $operator): array|Collection
    {
        return Movie::where($param, 'like', '%' . $operator . '%')->get();
    }

    public function allByWhereFast(string $param, $operator): object
    {
        return Movie::where($param, 'like', '%' . $operator . '%')->first();
    }

    public function allWhereGatherParam(string $param, $operator): array|Collection
    {
        return Movie::where($param, '>', $operator)->get();
    }
}
