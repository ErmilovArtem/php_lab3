<?php
namespace App\Http\ApiV1\Modules\Studios\Resources;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/** @mixin \App\Models\Studio */
class StudiosResource extends BaseJsonResource
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
        return $collection->map(function ($studio) {
            return $this->singleResponse($studio);
        })->toArray();
    }

    private function singleResponse(Model $studio): array
    {
        return [
            'id' => $studio->id,
            'name' => $studio->name,
            'year_of_foundation' => $studio->year_of_foundation,
            'active' => $studio->active,
            'description' => $studio->description,
            'created_at' => $studio->created_at,
            'updated_at' => $studio->updated_at,
        ];
    }
}
