<?php

namespace API\Movie;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MovieCreateTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_create_movie_201(): void
    {
        $movieData = [
            'name' => 'string',
            'description' => "string",
            'year' => "2023-06-06",
            'genre' => "string",
            'image' => "stringstring",
            'rating' => "5",
            'director_id' => "20",
        ];

        $response = $this->post('/api/v1/movies', $movieData);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'full_name' => 'string',
            'description' => "string",
            'image' => "stringstring",
        ]);

        $this->assertDatabaseHas('movies', [
            'full_name' => 'string',
            'description' => "string",
        ]);
    }

    public function test_create_movie_422(): void
    {
        $movieData = [
            'name' => 'string',
            'description' => "string",
            'year' => "2023-06-06",
            'genre' => "string",
            'image' => "stringstring",
            'rating' => "5",
            'director_id' => "20",
        ];

        $response = $this->post('/api/v1/movies', $movieData);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the Movie exists in the database
        $this->assertDatabaseMissing('movies', [
            'full_name' => 'string',
            'description' => "string",
        ]);
    }
}
