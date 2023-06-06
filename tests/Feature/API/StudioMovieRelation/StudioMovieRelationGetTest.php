<?php

namespace API\StudioMovieRelation;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudioMovieRelationGetTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_get_studioMovieRelation_200(): void
    {
        $studioMovieRelationData = [
            'studio_id' => 42,
            'movie_id' => 24,
        ];

        $this->patch('/api/v1/studioMovieRelations/42', $studioMovieRelationData);

        $response = $this->get('/api/v1/studioMovieRelations/getById/42');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'studio_id' => 42,
            'movie_id' => 24,
        ]);
    }

    public function test_get_studioMovieRelation_404_byId(): void
    {
        $response = $this->get('/api/v1/studioMovieRelations/studioMovieRelations/42000');

        $response->assertStatus(404);
    }
}
