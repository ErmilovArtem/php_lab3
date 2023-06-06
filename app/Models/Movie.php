<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**@mixin \Eloquent */
class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'year', 'genre', 'image', 'rating', 'director_id'];

    public function studios(): BelongsToMany
    {
        return $this->belongsToMany(Studio::class, 'studio_movie', 'movie_id', 'studio_id');
    }

    public function directors()
    {
        return $this->belongsTo(Director::class, 'director_id');
    }

}
