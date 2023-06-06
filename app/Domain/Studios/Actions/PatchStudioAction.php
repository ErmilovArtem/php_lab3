<?php

namespace App\Domain\Studios\Actions;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PatchStudioAction
{
    public function execute(int $studioId, array $fields): Builder|array|Collection|Model
    {
        $user = Studio::findOrFail($studioId);
        $user->update($fields);
        return $user;
    }
}
