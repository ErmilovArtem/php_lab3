<?php

namespace App\Http\ApiV1\Modules\Studios\Queries;

use App\Models\Studio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class StudiosQuery
{
    public function findOrFail(int $studioId): Studio
    {
        $studio = Studio::findOrFail($studioId);
        return $studio;
    }

    public function find(int $studioId): Model|Collection|Studio|array|null
    {
        $studio = Studio::find($studioId);
        return $studio;
    }

    public function findAll(): Model|Collection|Studio|array|null
    {
        $studio = Studio::all();
        return $studio;
    }

    public function allByOrder(string $param, bool $Desc = false): \Illuminate\Support\Collection
    {
        if (!$Desc)
            return Studio::orderBy($param)->get();
        else
            return Studio::orderBy($param, "desc")->get();
    }

    public function allByWhere(string $param, $operator): array|Collection
    {
        return Studio::where($param, $operator)->get();

    }
}
