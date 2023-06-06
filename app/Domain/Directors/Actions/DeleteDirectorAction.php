<?php

namespace App\Domain\Directors\Actions;

use App\Models\Director;

class DeleteDirectorAction
{
    public function execute(int $directorId): void
    {
        $studio = Director::findOrFail($directorId);
        $studio->delete();
    }
}
