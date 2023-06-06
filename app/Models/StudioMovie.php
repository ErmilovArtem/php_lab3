<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**@mixin \Eloquent */
class StudioMovie extends Model
{
    protected $fillable = ['movie_id', 'studio_id'];
    //php artisan make:model BannerCategory -f
    use HasFactory;

    protected $table = 'studio_movie';
}
