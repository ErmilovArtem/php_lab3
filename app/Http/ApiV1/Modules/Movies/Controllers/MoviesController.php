<?php

namespace App\Http\ApiV1\Modules\Movies\Controllers;

use App\Domain\Movies\Actions\CreateMovieAction;
use App\Domain\Movies\Actions\DeleteMovieAction;
use App\Domain\Movies\Actions\PatchMovieAction;
use App\Http\ApiV1\Modules\Directors\Resources\DirectorsResource;
use App\Http\ApiV1\Modules\Movies\Queries\MoviesQuery;
use App\Http\ApiV1\Modules\Movies\Requests\CreateMovieRequest;
use App\Http\ApiV1\Modules\Movies\Requests\PatchMovieRequest;
use App\Http\ApiV1\Modules\Movies\Requests\ReplaceMovieRequest;
use App\Http\ApiV1\Modules\Movies\Resources\MoviesResource;
use App\Http\ApiV1\Modules\Studios\Resources\StudiosResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;
use App\Models\Director;
use App\Models\Movie;

class MoviesController
{
    public function create(CreateMovieRequest $request, CreateMovieAction $action)
    {
        $validatedData = $request->validated();

        $directorId = $validatedData['director_id'];

        if (!is_null($directorId)) {
            $directorExists = Director::where('id', $directorId)->exists();

            if (!$directorExists) {
                return response()->json(['error' => 'Invalid director ID.'], 404);
            }
        }

        $movie = $action->execute($validatedData);

        return new MoviesResource($movie);
    }

    public function patch(int $MoviesId, PatchMovieRequest $request, PatchMovieAction $action)
    {
        $validatedData = $request->validated();

        $directorId = $validatedData['director_id'];

        if (!is_null($directorId)) {
            $directorExists = Director::where('id', $directorId)->exists();

            if (!$directorExists) {
                return response()->json(['error' => 'Invalid director ID.'], 404);
            }
        }

        $movie = $action->execute($MoviesId, $validatedData);

        return new MoviesResource($movie);
    }

    public function replace(int $MoviesId, ReplaceMovieRequest $request, PatchMovieAction $action)
    {
        return new MoviesResource(
            $action->execute($MoviesId, $request->validated())
        );
    }


    public function delete(int $MoviesId, DeleteMovieAction $action)
    {
        $action->execute($MoviesId);
        return response()->json(new EmptyResource(), 204);
    }

    public function get(int $MoviesId, MoviesQuery $query)
    {

        $movie = $query->findOrFail($MoviesId);

        return new MoviesResource($movie);
    }

    public function getAll(MoviesQuery $query)
    {
        $movies = $query->findAll();

        if ($movies->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }

        return new MoviesResource($movies);
    }

    ////
    public function getDirectorOfMovie(int $MoviesId, MoviesQuery $query)
    {
        $movies = $query->findOrFail($MoviesId);

        $director = $movies->director;

        if (!$director) {
            return response()->json(['message' => 'Director not found.'], 404);
        }

        return new DirectorsResource($director);
    }

    public function getStudiosByMovie(int $movieId)
    {
        $movie = Movie::findOrFail($movieId);

        $studios = $movie->studios;

        if ($studios->isEmpty()) {
            return response()->json(['message' => 'No studios found for this movie.'], 204);
        }

        return new StudiosResource($studios);
    }


    public function allByOrderNameAsc(MoviesQuery $query)
    {
        $movies = $query->allByOrder("name");
        if ($movies->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new MoviesResource($movies);
    }

    public function allByOrderNameDesc(MoviesQuery $query)
    {
        $movies = $query->allByOrder("name", true);
        if ($movies->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new MoviesResource($movies);
    }

    public function allByOrderDateAsc(MoviesQuery $query)
    {
        $movies = $query->allByOrder("year");
        if ($movies->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new MoviesResource($movies);
    }

    public function allByOrderDateDesc(MoviesQuery $query)
    {
        $movies = $query->allByOrder("year", true);
        if ($movies->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new MoviesResource($movies);
    }

    public function allByName(string $name, MoviesQuery $query)
    {
        $movies = $query->allByWhere("name", $name);
        if ($movies->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new MoviesResource($movies);
    }

    public function allByGenre(string $genre, MoviesQuery $query)
    {
        $movies = $query->allByWhere("genre", $genre);

        if ($movies->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new MoviesResource($movies);
    }

    public function allByGenreFast(string $genre, MoviesQuery $query)
    {
        $movies = $query->allByWhereFast("genre", $genre);

        if ($movies->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new MoviesResource($movies);
    }

    public function allByGatherRating(int $rating, MoviesQuery $query)
    {
        $movies = $query->allWhereGatherParam("rating", $rating);

        if ($movies->isEmpty()) {
            return response()->json(['message' => 'Пусто'], 204);
        }
        return new MoviesResource($movies);
    }
}
