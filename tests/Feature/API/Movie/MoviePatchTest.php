<?php

namespace API\Movie;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MoviePatchTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_patch_movies_200(): void
    {
        $moviesData = [
            'name' => 'string',
            'description' => "string",
            'year' => "2023-06-06",
            'genre' => "string",
            'rating' => "5",
            'movie_id' => "20",
        ];

        $response = $this->patch('/api/v1/movies/44', $moviesData);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'genre' => "string",
            'image' => "stringstring",
            'rating' => "5",
        ]);

        // Assert that the movies exists in the database
        $this->assertDatabaseHas('movies', [
            'genre' => "string",
            'image' => "stringstring",
            'rating' => "5",
        ]);
    }

    public function test_patch_movies_422_byInvalid(): void
    {
        $moviesData = [
            'full_name' => 'My movies Test',
            'description' => "2000-01",
            'date_of_birth' => "2023-06",
        ];

        $response = $this->patch('/api/v1/movies/48', $moviesData);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the movies exists in the database
        $this->assertDatabaseMissing('movies', [
            'full_name' => $moviesData['full_name'],
        ]);
    }

    public function test_patch_movies_404_byId(): void
    {
        $moviesData = [
            'genre' => "string",
            'image' => "stringstring",
            'rating' => "5",
        ];

        $response = $this->patch('/api/v1/movies/1000', $moviesData);

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the movies exists in the database
        $this->assertDatabaseMissing('movies', [
            'full_name' => $moviesData['full_name'],
        ]);
    }
}
