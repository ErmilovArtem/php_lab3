<?php

namespace API\Movie;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MovieDeliteTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_delete_movie_204(): void
    {
        $response = $this->delete('/api/v1/movies/42');

        $response->assertStatus(204);

        // Assert that the Movie exists in the database
        $this->assertDatabaseHas('movies', [
            'id' => 44,
        ]);
    }

    public function test_delete_movie_404_byId(): void
    {
        $response = $this->delete('/api/v1/movies/4200');

        $response->assertStatus(404);

        // Assert that the Movie exists in the database
        $this->assertDatabaseHas('movies', [
            'id' => 44,
        ]);
    }

}
