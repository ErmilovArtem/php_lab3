<?php

namespace App\Domain\Directors\Actions;

use App\Models\Director;

class CreateDirectorAction
{
    public function execute(array $data): Director
    {
        return Director::create($data);
    }
}
