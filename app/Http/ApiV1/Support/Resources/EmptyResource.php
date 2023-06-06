<?php

namespace App\Http\ApiV1\Support\Resources;

class EmptyResource
{
    public function toArray($request)
    {
        return [];
    }
}
