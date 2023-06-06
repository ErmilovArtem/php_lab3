<?php

namespace API\StudioMovieRelation;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudioMovieRelationDeliteTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_delete_studioMovieRelation_204(): void
    {
        $response = $this->delete('/api/v1/studioMovieRelations/42');

        $response->assertStatus(204);

        // Assert that the studioMovieRelation exists in the database
        $this->assertDatabaseHas('studioMovieRelations', [
            'id' => 44,
        ]);
    }

    public function test_delete_studioMovieRelation_404_byId(): void
    {
        $response = $this->delete('/api/v1/studioMovieRelations/4200');

        $response->assertStatus(404);

        // Assert that the studioMovieRelation exists in the database
        $this->assertDatabaseHas('studioMovieRelations', [
            'id' => 44,
        ]);
    }

}
