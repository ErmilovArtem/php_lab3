<?php

namespace App\Http\ApiV1\Modules\Movies\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class ReplaceMovieRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:55'],
            'description' => ['required', 'string'],
            'year' => ['required', 'date', 'date_format:Y-m-d'],
            'genre' => ['required', 'string', 'string', 'min:3', 'max:55'],
            'image' => ['required', 'string', 'string', 'min:10', 'max:55'],
            'rating' => ['required', 'numeric', 'min:1', 'max:10'],
            'director_id' => ['required', 'integer', 'min:1'],
        ];
    }
}
