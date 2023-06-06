<?php

namespace API\StudioMovieRelation;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudioMovieRelationPatchTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_patch_studioMovieRelations_200(): void
    {
        $studioMovieRelationsData = [
            'studio_id' => 43,
            'movie_id' => 23,
        ];

        $response = $this->patch('/api/v1/studioMovieRelations/44', $studioMovieRelationsData);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'studio_id' => 43,
            'movie_id' => 23,
        ]);

        // Assert that the studioMovieRelations exists in the database
        $this->assertDatabaseHas('studioMovieRelations', [
            'studio_id' => 43,
            'movie_id' => 23,
        ]);
    }

    public function test_patch_studioMovieRelations_404_byInvalidInput(): void
    {
        $studioMovieRelationsData = [
            'studio_id' => 42000,
            'movie_id' => 24000,
        ];

        $response = $this->patch('/api/v1/studioMovieRelations/48', $studioMovieRelationsData);

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the studioMovieRelations exists in the database
        $this->assertDatabaseMissing('studioMovieRelations', [
            'studio_id' => 43,
            'movie_id' => 23,
        ]);
    }

    public function test_patch_studioMovieRelations_404_byId(): void
    {
        $studioMovieRelationsData = [
            'studio_id' => 43,
            'movie_id' => 23,
        ];

        $response = $this->patch('/api/v1/studioMovieRelations/10000', $studioMovieRelationsData);

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the studioMovieRelations exists in the database
        $this->assertDatabaseMissing('studioMovieRelations', [
            'studio_id' => 42,
            'movie_id' => 24,
        ]);
    }
}
