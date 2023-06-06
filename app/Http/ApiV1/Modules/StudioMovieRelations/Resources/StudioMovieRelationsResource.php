<?php
namespace App\Http\ApiV1\Modules\StudioMovieRelations\Resources;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/** @mixin \App\Models\Studio */
class StudioMovieRelationsResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        if ($this->resource instanceof Collection) {
            return $this->collectionResponse($this->resource);
        } else {
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
            'studio_id' => $studio->studio_id,
            'movie_id' => $studio->movie_id,
        ];
    }
}
