<?php

namespace App\Http\ApiV1\Modules\Movies\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/** @mixin \App\Models\Movie */
class MoviesResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        if ($this->resource instanceof Collection) {
            // Обрабатываем коллекцию моделей
            return $this->collectionResponse($this->resource);
        } else {
            // Обрабатываем одиночную модель
            return $this->singleResponse($this->resource);
        }
    }

    private function collectionResponse(Collection $collection): array
    {
        return $collection->map(function ($movie) {
            return $this->singleResponse($movie);
        })->toArray();
    }

    private function singleResponse(Model $movie): array
    {
        return [
            'id' => $movie->id,
            'name' => $movie->name,
            'description' => $movie->description,
            'year' => $movie->year,
            'genre' => $movie->genre,
            'image' => $movie->image,
            'rating' => $movie->rating,
            'director_id' => $movie->director_id,
            'created_at' => $movie->created_at,
            'updated_at' => $movie->updated_at,
        ];
    }
}
