<?php
namespace App\Http\ApiV1\Modules\Directors\Controllers;
use App\Domain\Directors\Actions\CreateDirectorAction;  //
use App\Domain\Directors\Actions\DeleteDirectorAction;  //
use App\Domain\Directors\Actions\PatchDirectorAction;
use App\Http\ApiV1\Modules\Directors\Queries\DirectorsQuery;  //
use App\Http\ApiV1\Modules\Directors\Requests\CreateDirectorRequest;  //
use App\Http\ApiV1\Modules\Directors\Requests\PatchDirectorRequest;
use App\Http\ApiV1\Modules\Directors\Requests\ReplaceDirectorRequest;
use App\Http\ApiV1\Modules\Directors\Resources\DirectorsResource;
use App\Http\ApiV1\Modules\Movies\Resources\MoviesResource;
use App\Http\ApiV1\Modules\Studios\Resources\StudiosResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;  //
use App\Models\Director;
use App\Models\Movie;
class DirectorsController
{
    public function create(CreateDirectorRequest $request, CreateDirectorAction $action)
    {
        return new DirectorsResource($action->execute($request->validated()));
    }

    public function patch(int $directorId, PatchDirectorRequest $request, PatchDirectorAction $action)
    {
        return new DirectorsResource(
            $action->execute($directorId, $request->validated())
        );
    }

    public function replace(int $directorId, ReplaceDirectorRequest $request, PatchDirectorAction $action)
    {
        return new DirectorsResource(
            $action->execute($directorId, $request->validated())
        );
    }

    public function delete(int $directorId, DeleteDirectorAction $action)
    {
        $action->execute($directorId);
        return response()->json(new EmptyResource(), 204);
    }

    public function get(int $directorId, DirectorsQuery $query)
    {

        $director = $query->findOrFail($directorId);

        return new DirectorsResource($director);
    }

    public function getAll(DirectorsQuery $query)
    {
        $directors = $query->findAll();

        if ($directors->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }

        return new DirectorsResource($directors);
    }

    ////
    public function allByOrderNameAsc(DirectorsQuery $query)
    {
        $directors = $query->allByOrder("full_name");
        if ($directors->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new DirectorsResource($directors);
    }

    public function allByOrderNameDesc(DirectorsQuery $query)
    {
        $directors = $query->allByOrder("full_name", true);
        if ($directors->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new DirectorsResource($directors);
    }

    public function allMoviesByDirId(int $directorId)
    {
        $movies = Movie::where('director_id', $directorId)->get();

        if ($movies->isEmpty()) {
            return response()->json(['message' => 'No movies found for this director.'], 204);
        }

        return new MoviesResource($movies);
    }

    public function getStudiosByDirector(int $directorId)
    {
        $director = Director::findOrFail($directorId);

        $directors = $director->studios;

        if ($directors->isEmpty()) {
            return response()->json(['message' => 'No studios found for this director.'], 204);
        }

        return new StudiosResource($directors);
    }
}
