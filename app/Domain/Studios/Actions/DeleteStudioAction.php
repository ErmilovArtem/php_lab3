<?php

namespace App\Domain\Studios\Actions;

use App\Models\Studio;

class DeleteStudioAction
{
    public function execute(int $studioId): void
    {
        $studio = Studio::findOrFail($studioId);
        $studio->delete();
    }
}
