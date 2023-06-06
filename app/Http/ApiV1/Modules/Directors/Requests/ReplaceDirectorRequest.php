<?php

namespace App\Http\ApiV1\Modules\Directors\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class ReplaceDirectorRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:3', 'max:55'],
            'description' => ['required', 'string'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d'],
            'date_of_debute' => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }
}
