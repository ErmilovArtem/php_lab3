<?php

namespace API\Director;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DirectorManyGetsTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_all_directors_200(): void
    {
        $response = $this->get('/api/v1/directors/allByOrderNameAsc');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_allMoviesByDirId_directors_200(): void
    {
        $response = $this->get('/api/v1/directors/allByOrderNameDesc');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_getDirectorssByDirector_directors_200(): void
    {
        $response = $this->get('/api/v1/directors/allMoviesByDirId/42');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_getDirectorssByDirector_directors_404(): void
    {
        $response = $this->get('/api/v1/directors/allMoviesByDirId/4200');

        $response->assertStatus(404);
    }

    public function test_get_active_directors_200(): void
    {
        $response = $this->get('/api/v1/directors/getById/getStudiosByDirector/42');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_active_directors_404(): void
    {
        $response = $this->get('/api/v1/directors/getById/getStudiosByDirector/4200');

        $response->assertStatus(404);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }
}
