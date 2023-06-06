<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**@mixin \Eloquent */
class Director extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'description', 'date_of_birth', 'date_of_debute'];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function studios()
    {
        return $this->hasManyThrough(Studio::class, StudioMovie::class, 'movie_id', 'id', 'id', 'studio_id')
            ->distinct();
    }


}
