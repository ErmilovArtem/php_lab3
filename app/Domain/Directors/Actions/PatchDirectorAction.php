<?php

namespace App\Domain\Directors\Actions;
use App\Models\Director;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PatchDirectorAction
{
    public function execute(int $directorId, array $fields): Builder|array|Collection|Model
    {
        $user = Director::findOrFail($directorId);
        $user->update($fields);
        return $user;
    }
}
