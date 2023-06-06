<?php

namespace API\Director;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DirectorPutTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_put_directors_200(): void
    {
        $directorsData = [
            'full_name' => 'string',
            'description' => "string",
            'date_of_birth' => "2023-06-06",
            'date_of_debute' => "2023-06-06",
        ];

        $response = $this->put('/api/v1/directors/44', $directorsData);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'full_name' => 'string',
            'description' => "string",
        ]);

        // Assert that the directors exists in the database
        $this->assertDatabaseHas('directors', [
            'full_name' => $directorsData['full_name'],
            'description' => $directorsData['description'],
        ]);
    }

    public function test_put_directors_422_byInvalid(): void
    {
        $directorsData = [
            'full_name' => 'My directors Test',
            'description' => "2000-01-01",
        ];

        $response = $this->put('/api/v1/directors/48', $directorsData);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the directors exists in the database
        $this->assertDatabaseMissing('directors', [
            'full_name' => $directorsData['name'],
        ]);
    }

    public function test_put_directors_404_byId(): void
    {
        $directorsData = [
            'full_name' => 'My directors Test Patch',
            'description' => "2000-01-01",
        ];

        $response = $this->put('/api/v1/directors/1000', $directorsData);

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the directors exists in the database
        $this->assertDatabaseMissing('directors', [
            'full_name' => $directorsData['name'],
        ]);
    }


}
