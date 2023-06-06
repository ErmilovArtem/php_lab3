<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**@mixin \Eloquent */
class Studio extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'year_of_foundation', 'active', 'description'];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }
}
