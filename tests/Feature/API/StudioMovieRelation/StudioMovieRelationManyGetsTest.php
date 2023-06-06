<?php

namespace API\StudioMovieRelation;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StudioMovieRelationManyGetsTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_all_directors_200(): void
    {
        $response = $this->get('/api/v1/studioMovieRelations');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }
}
