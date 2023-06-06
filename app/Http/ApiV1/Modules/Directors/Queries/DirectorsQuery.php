<?php

namespace App\Http\ApiV1\Modules\Directors\Queries;

use App\Models\Director;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DirectorsQuery
{
    public function findOrFail(int $studioId): Director
    {
        $studio = Director::findOrFail($studioId);
        return $studio;
    }

    public function find(int $studioId): Model|Collection|Director|array|null
    {
        $studio = Director::find($studioId);
        return $studio;
    }

    public function findAll(): Model|Collection|Director|array|null
    {
        $studio = Director::all();
        return $studio;
    }

    public function allByOrder(string $param, bool $Desc = false): \Illuminate\Support\Collection
    {
        if(!$Desc)
            return Director::orderBy($param)->get();
        else
            return Director::orderBy($param, "desc")->get();
    }

    public function allByWhere(string $param, $operator): array|Collection
    {
        return Director::where($param, $operator)->get();

    }
}
