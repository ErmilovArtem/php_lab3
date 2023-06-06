<?php

namespace App\Http\ApiV1\Modules\Studios\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class CreateStudioRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:55'],
            'year_of_foundation' => ['required', 'date', 'date_format:Y-m-d'],
            'active' => ['boolean'],
            'description' => ['nullable', 'string'],
        ];
    }
}
