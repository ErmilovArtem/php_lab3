<?php

namespace API\StudioMovieRelation;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudioMovieRelationCreateTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_create_studioMovieRelation_201(): void
    {
        $studioMovieRelationData = [
            'studio_id' => 43,
            'movie_id' => 23,
        ];

        $response = $this->post('/api/v1/studioMovieRelations', $studioMovieRelationData);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'studio_id' => 43,
            'movie_id' => 23,
        ]);

        // Assert that the studioMovieRelation exists in the database
        $this->assertDatabaseHas('studioMovieRelations', [
            'studio_id' => 43,
            'movie_id' => 23,
        ]);
    }

    public function test_create_studioMovieRelation_422(): void
    {
        $studioMovieRelationData = [
            'studio_id' => 42000,
            'movie_id' => 24000,
        ];

        $response = $this->post('/api/v1/studioMovieRelations', $studioMovieRelationData);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the studioMovieRelation exists in the database
        $this->assertDatabaseMissing('studioMovieRelations', [
            'studio_id' => 42000,
            'movie_id' => 24000,
        ]);
    }

    public function test_create_special_studioMovieRelation_201(): void
    {
        $response = $this->post('/api/v1/studioMovieRelations/studio/43/movie/23');

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'studio_id' => 43,
            'movie_id' => 23,
        ]);

        // Assert that the studioMovieRelation exists in the database
        $this->assertDatabaseHas('studioMovieRelations', [
            'studio_id' => 43,
            'movie_id' => 23,
        ]);
    }

    public function test_create_special_studioMovieRelation_422(): void
    {

        $response = $this->post('/api/v1/studioMovieRelations/studio/42000/movie/24000');

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the studioMovieRelation exists in the database
        $this->assertDatabaseMissing('studioMovieRelations', [
            'studio_id' => 42000,
            'movie_id' => 24000,
        ]);
    }
}
