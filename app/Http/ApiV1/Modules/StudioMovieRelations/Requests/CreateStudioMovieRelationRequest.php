<?php

namespace App\Http\ApiV1\Modules\StudioMovieRelations\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class CreateStudioMovieRelationRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'studio_id' => ['required', 'integer', 'min:1'],
            'movie_id' => ['required', 'integer', 'min:1'],
        ];
    }
}
