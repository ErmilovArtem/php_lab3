<?php

use App\Http\ApiV1\Modules\Directors\Controllers\DirectorsController;
use App\Http\ApiV1\Modules\Movies\Controllers\MoviesController;
use App\Http\ApiV1\Modules\StudioMovieRelations\Controllers\StudioMovieRelationsController;
use App\Http\ApiV1\Modules\Studios\Controllers\StudiosController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return 'This is start page.';
});

Route::post('/api/v1/studios', [StudiosController::class, 'create']);
Route::patch('/api/v1/studios/{studioId}', [StudiosController::class, 'patch']);
Route::put('/api/v1/studios/{studioId}', [StudiosController::class, 'replace']);
Route::delete('/api/v1/studios/{studioId}', [StudiosController::class, 'delete']);
Route::get('/api/v1/studios/getById/{studioId}', [StudiosController::class, 'get']);

Route::get('/api/v1/studios/all', [StudiosController::class, 'getAll']);
Route::get('/api/v1/studios/active', [StudiosController::class, 'allWhereStudioActive']);
Route::get('/api/v1/studios/allByOrderNameAsc', [StudiosController::class, 'allByOrderNameAsc']);
Route::get('/api/v1/studios/allByOrderNameDesc', [StudiosController::class, 'allByOrderNameDesc']);
Route::get('/api/v1/studios/allByOrderDateAsc', [StudiosController::class, 'allByOrderDateAsc']);
Route::get('/api/v1/studios/allByOrderDateDesc', [StudiosController::class, 'allByOrderDateDesc']);

Route::post('/api/v1/directors', [DirectorsController::class, 'create']);
Route::patch('/api/v1/directors/{directorId}', [DirectorsController::class, 'patch']);
Route::put('/api/v1/directors/{directorId}', [DirectorsController::class, 'replace']);
Route::delete('/api/v1/directors/{directorId}', [DirectorsController::class, 'delete']);
Route::get('/api/v1/directors/allByOrderNameAsc', [DirectorsController::class, 'allByOrderNameAsc']);
Route::get('/api/v1/directors/allByOrderNameDesc', [DirectorsController::class, 'allByOrderNameDesc']);
Route::get('/api/v1/directors/allMoviesByDirId/{directorId}', [DirectorsController::class, 'allMoviesByDirId']);
Route::get('/api/v1/directors/getStudiosByDirector/{directorId}', [DirectorsController::class, 'getStudiosByDirector']);

Route::get('/api/v1/directors', [DirectorsController::class, 'getAll']);
Route::get('/api/v1/directors/getById/{directorId}', [DirectorsController::class, 'get']);


Route::get('/api/v1/movies/{movieId}/director', [MoviesController::class, 'getDirectorOfMovie']);
Route::get('/api/v1/movies/{movieId}/studios', [MoviesController::class, 'getStudiosByMovie']);
Route::get('/api/v1/movies/orderByNameAsc', [MoviesController::class, 'allByOrderNameAsc']);
Route::get('/api/v1/movies/orderByNameDesc', [MoviesController::class, 'allByOrderNameDesc']);
Route::get('/api/v1/movies/orderByDateAsc', [MoviesController::class, 'allByOrderDateAsc']);
Route::get('/api/v1/movies/orderByDateDesc', [MoviesController::class, 'allByOrderDateDesc']);
Route::get('/api/v1/movies/name/{name}', [MoviesController::class, 'allByName']);
Route::get('/api/v1/movies/genre/{genre}', [MoviesController::class, 'allByGenre']);
Route::get('/api/v1/movies/genreFast/{genre}', [MoviesController::class, 'allByGenreFast']);
Route::get('/api/v1/movies/gatherRating/{rating}', [MoviesController::class, 'allByGatherRating']);

Route::post('/api/v1/movies', [MoviesController::class, 'create']);
Route::patch('/api/v1/movies/{movieId}', [MoviesController::class, 'patch']);
Route::put('/api/v1/movies/{movieId}', [MoviesController::class, 'replace']);
Route::delete('/api/v1/movies/{movieId}', [MoviesController::class, 'delete']);

Route::get('/api/v1/movies', [MoviesController::class, 'getAll']);
Route::get('/api/v1/movies/{movieId}', [MoviesController::class, 'get']);


Route::post('/api/v1/studioMovieRelations', [StudioMovieRelationsController::class, 'create']);
Route::put('/api/v1/studioMovieRelations/{relationId}', [StudioMovieRelationsController::class, 'replace']);
Route::delete('/api/v1/studioMovieRelations/{relationId}', [StudioMovieRelationsController::class, 'delete']);

Route::get('/api/v1/studioMovieRelations', [StudioMovieRelationsController::class, 'getAll']);
Route::get('/api/v1/studioMovieRelations/{relationId}', [StudioMovieRelationsController::class, 'get']);
Route::get('/api/v1/studioMovieRelations/movie/{movieId}', [StudioMovieRelationsController::class, 'allByMovieId']);
Route::get('/api/v1/studioMovieRelations/studio/{studioId}', [StudioMovieRelationsController::class, 'allByStudioId']);

Route::post('/api/v1/studioMovieRelations/studio/{studioId}/movie/{movieId}', [StudioMovieRelationsController::class, 'createRelation']);

