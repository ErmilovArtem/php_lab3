<?php

namespace App\Http\ApiV1\Modules\Movies\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class PatchMovieRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:55'],
            'description' => ['string'],
            'year' => ['required', 'date', 'date_format:Y-m-d'],
            'genre' => ['string', 'string', 'min:3', 'max:55'],
            'image' => ['string', 'string', 'min:10', 'max:55'],
            'rating' => ['numeric', 'min:1', 'max:10'],
            'director_id' => ['integer', 'min:1'],
        ];
    }
}
