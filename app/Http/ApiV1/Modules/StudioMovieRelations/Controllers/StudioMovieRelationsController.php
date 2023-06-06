<?php

namespace App\Http\ApiV1\Modules\StudioMovieRelations\Controllers;

use App\Domain\StudioMovieRelations\Actions\CreateStudioMovieRelationAction;

//
use App\Domain\StudioMovieRelations\Actions\DeleteStudioMovieRelationAction;

//
use App\Domain\StudioMovieRelations\Actions\PatchStudioMovieRelationAction;
use App\Http\ApiV1\Modules\StudioMovieRelations\Queries\StudioMovieRelationsQuery;

//
use App\Http\ApiV1\Modules\StudioMovieRelations\Requests\CreateStudioMovieRelationRequest;

//
use App\Http\ApiV1\Modules\StudioMovieRelations\Requests\ReplaceStudioMovieRelationRequest;
use App\Http\ApiV1\Modules\StudioMovieRelations\Resources\StudioMovieRelationsResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;

//
use App\Models\Movie;
use App\Models\Studio;
use App\Models\StudioMovie;

class StudioMovieRelationsController
{
    public function create(CreateStudioMovieRelationRequest $request, CreateStudioMovieRelationAction $action)
    {
        beginDatabaseTransaction();
        $validatedData = $request->validated();

        $movieId = $validatedData['movie_id'];
        $relationId = $validatedData['studio_id'];

        $relationExists = StudioMovie::where('movie_id', $movieId)
            ->where('studio_id', $relationId)
            ->exists();

        if ($relationExists) {
            return response()->json(['error' => 'The relation already exists.'], 409);
        }

        $movieExists = Movie::where('id', $movieId)->exists();
        $relationExists = Studio::where('id', $relationId)->exists();

        if (!$movieExists || !$relationExists) {
            return response()->json(['error' => 'One or both IDs are invalid.'], 404);
        }

        $relation = $action->execute($validatedData);

        return new StudioMovieRelationsResource($relation);
    }

    public function replace(int $relationId, ReplaceStudioMovieRelationRequest $request, PatchStudioMovieRelationAction $action)
    {
        $validatedData = $request->validated();

        $movieId = $validatedData['movie_id'];
        $relationId = $validatedData['studio_id'];

        $relationExists = StudioMovie::where('movie_id', $movieId)
            ->where('studio_id', $relationId)
            ->exists();

        if ($relationExists) {
            return response()->json(['error' => 'The relation already exists.'], 409);
        }

        $movieExists = Movie::where('id', $movieId)->exists();
        $relationExists = Studio::where('id', $relationId)->exists();

        if (!$movieExists || !$relationExists) {
            return response()->json(['error' => 'One or both IDs are invalid.'], 404);
        }

        $relation = $action->execute($relationId, $validatedData);

        return new StudioMovieRelationsResource($relation);
    }

    public function delete(int $relationId, DeleteStudioMovieRelationAction $action)
    {
        $action->execute($relationId);
        return response()->json(new EmptyResource(), 204);
    }

    public function get(int $relationId, StudioMovieRelationsQuery $query)
    {

        $relation = $query->findOrFail($relationId);

        return new StudioMovieRelationsResource($relation);
    }

    public function getAll(StudioMovieRelationsQuery $query)
    {
        $relations = $query->findAll();

        if ($relations->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }

        return new StudioMovieRelationsResource($relations);
    }

    ////
    public function allByMovieId(int $movieId, StudioMovieRelationsQuery $query)
    {
        $relations = $query->allByWhere("movie_id", $movieId);
        if ($relations->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new StudioMovieRelationsResource($relations);
    }

    public function allByStudioId(int $relationId, StudioMovieRelationsQuery $query)
    {
        $relations = $query->allByWhere("movie_id", $relationId);
        if ($relations->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new StudioMovieRelationsResource($relations);
    }

    public function createRelation(int $relationId, int $movieId, CreateStudioMovieRelationAction $action)
    {
        $relationData = [
            'movie_id' => $movieId,
            'studio_id' => $relationId,
        ];

        $relation = $action->execute($relationData);

        return new StudioMovieRelationsResource($relation);
    }
}
