<?php

namespace API\Movie;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class MovieManyGetsTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_all_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_allorderByDateAsc_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/orderByDateAsc');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_getorderByDateDesc_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/orderByDateDesc');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_orderByNameDesc_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/getById/orderByNameDesc');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_orderByNameAsc_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/getById/orderByNameAsc');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_by_name_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/name/Name');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_by_genre_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/genre/Drama');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_by_genre_fast_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/genre/Drama');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_by_genre_movies_204(): void
    {
        $response = $this->get('/api/v1/movies/genre/NAma');

        $response->assertStatus(204);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_by_genre_fast_movies_204(): void
    {
        $response = $this->get('/api/v1/movies/genre/Nama');

        $response->assertStatus(204);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }
    public function test_get__by_gatherRating_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/gatherRating/5');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_director_by_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/42/director');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_studios_by_movies_200(): void
    {
        $response = $this->get('/api/v1/movies/42/studios');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }
}
