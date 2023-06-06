<?php

namespace App\Domain\Studios\Actions;

use App\Models\Studio;

class CreateStudioAction
{
    public function execute(array $data): Studio
    {
        return Studio::create($data);
    }
}
