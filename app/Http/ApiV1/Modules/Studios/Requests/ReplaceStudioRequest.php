<?php

namespace App\Http\ApiV1\Modules\Studios\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class ReplaceStudioRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'year_of_foundation' => ['required', 'date', 'date_format:Y-m-d'],
            'active' => ['required', 'boolean'],
            'description' => ['required', 'string'],
        ];
    }
}
