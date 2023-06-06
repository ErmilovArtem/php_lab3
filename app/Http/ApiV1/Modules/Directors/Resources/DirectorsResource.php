<?php

namespace App\Http\ApiV1\Modules\Directors\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/** @mixin \App\Models\Director */
class DirectorsResource extends BaseJsonResource
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
        return $collection->map(function ($director) {
            return $this->singleResponse($director);
        })->toArray();
    }

    private function singleResponse(Model $director): array
    {
        return [
            'id' => $director->id,
            'full_name' => $director->full_name,
            'description' => $director->description,
            'date_of_birth' => $director->date_of_birth,
            'date_of_debute' => $director->date_of_debute,
            'created_at' => $director->created_at,
            'updated_at' => $director->updated_at,
        ];
    }
}
