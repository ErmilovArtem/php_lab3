<?php

namespace API\Studio;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudioCreateTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_create_studio_201(): void
    {
        $studioData = [
            'name' => 'My Studio',
            'year_of_foundation' => "2000-01-01",
            'active' => true,
            'description' => 'Lorem ipsum dolor sit amet',
        ];

        $response = $this->post('/api/v1/studios', $studioData);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'name' => 'My Studio',
            'year_of_foundation' => '2000-01-01',
            'active' => true,
            'description' => 'Lorem ipsum dolor sit amet',
        ]);

        // Assert that the studio exists in the database
        $this->assertDatabaseHas('studios', [
            'name' => $studioData['name'],
            'year_of_foundation' => $studioData['year_of_foundation'],
            'active' => $studioData['active'],
            'description' => $studioData['description'],
        ]);
    }

    public function test_create_studio_422(): void
    {
        $studioData = [
            'name' => 'My Studio Test',
            'year_of_foundation' => "2000-01",
            'active' => true,
            'description' => 'Lorem ipsum dolor sit amet',
        ];

        $response = $this->post('/api/v1/studios', $studioData);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the studio exists in the database
        $this->assertDatabaseMissing('studios', [
            'name' => $studioData['name'],
            'active' => $studioData['active'],
            'description' => $studioData['description'],
        ]);
    }
}
