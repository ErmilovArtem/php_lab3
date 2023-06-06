<?php

namespace API\Director;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DirectorCreateTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_create_director_201(): void
    {
        $directorData = [
            'full_name' => 'string',
            'description' => "string",
            'date_of_birth' => "2023-06-06",
            'date_of_debute' => "2023-06-06",
        ];

        $response = $this->post('/api/v1/directors', $directorData);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'full_name' => 'string',
            'description' => "string",
            'date_of_birth' => "2023-06-06",
            'date_of_debute' => "2023-06-06",
        ]);

        // Assert that the director exists in the database
        $this->assertDatabaseHas('directors', [
            'full_name' => 'string',
            'description' => "string",
        ]);
    }

    public function test_create_director_422(): void
    {
        $directorData = [
            'full_name' => 'string',
            'description' => "string",
            'date_of_birth' => "2023-06-06",
            'date_of_debute' => "2023-06-06",
        ];

        $response = $this->post('/api/v1/directors', $directorData);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the director exists in the database
        $this->assertDatabaseMissing('directors', [
            'full_name' => 'string',
            'description' => "string",
        ]);
    }
}
