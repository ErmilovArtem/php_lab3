<?php

namespace App\Http\ApiV1\Modules\Studios\Controllers;

use App\Domain\Studios\Actions\CreateStudioAction;
use App\Domain\Studios\Actions\DeleteStudioAction;
use App\Domain\Studios\Actions\PatchStudioAction;
use App\Http\ApiV1\Modules\Studios\Queries\StudiosQuery;
use App\Http\ApiV1\Modules\Studios\Requests\CreateStudioRequest;
use App\Http\ApiV1\Modules\Studios\Requests\PatchStudioRequest;
use App\Http\ApiV1\Modules\Studios\Requests\ReplaceStudioRequest;
use App\Http\ApiV1\Modules\Studios\Resources\StudiosResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;


class StudiosController
{
    public function create(CreateStudioRequest $request, CreateStudioAction $action)
    {
        return new StudiosResource($action->execute($request->validated()));
    }

    public function patch(int $studioId, PatchStudioRequest $request, PatchStudioAction $action)
    {
        return new StudiosResource(
            $action->execute($studioId, $request->validated())
        );
    }

    public function replace(int $studioId, ReplaceStudioRequest $request, PatchStudioAction $action)
    {
        return new StudiosResource(
            $action->execute($studioId, $request->validated())
        );
    }

    public function delete(int $studioId, DeleteStudioAction $action)
    {
        $action->execute($studioId);
        return response()->json(new EmptyResource(), 204);
    }

    public function get(int $studioId, StudiosQuery $query)
    {

        $studio = $query->findOrFail($studioId);

        return new StudiosResource($studio);
    }

    public function getAll(StudiosQuery $query)
    {
        $studios = $query->findAll();

        if ($studios->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }

        return new StudiosResource($studios);
    }

    public function allByOrderNameAsc(StudiosQuery $query)
    {
        $studios = $query->allByOrder("name");


        if ($studios->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }

        return new StudiosResource($studios);
    }

    public function allByOrderNameDesc(StudiosQuery $query)
    {
        $studios = $query->allByOrder("name", true);

        if ($studios->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }

        return new StudiosResource($studios);
    }

    public function allByOrderDateAsc(StudiosQuery $query)
    {
        $studios = $query->allByOrder("year_of_foundation");

        if ($studios->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }

        return new StudiosResource($studios);
    }

    public function allByOrderDateDesc(StudiosQuery $query)
    {
        $studios = $query->allByOrder("year_of_foundation", true);

        if ($studios->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }

        return new StudiosResource($studios);
    }

    public function allWhereStudioActive(StudiosQuery $query)
    {
        $studios = $query->allByWhere("active", "true");

        if ($studios->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }

        return new StudiosResource($studios);
    }
}
