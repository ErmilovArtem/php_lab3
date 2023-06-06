<?php

namespace API\Movie;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MovieGetTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_get_director_200(): void
    {
        $directorData = [
            'full_name' => 'string',
            'description' => "string",
            'date_of_birth' => "2023-06-06",
            'date_of_debute' => "2023-06-06",
        ];

        $this->patch('/api/v1/directors/42', $directorData);

        $response = $this->get('/api/v1/directors/getById/42');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'full_name' => 'string',
            'description' => "string",
        ]);
    }

    public function test_get_director_404_byId(): void
    {
        $response = $this->get('/api/v1/directors/directors/42');

        $response->assertStatus(404);
    }
}
