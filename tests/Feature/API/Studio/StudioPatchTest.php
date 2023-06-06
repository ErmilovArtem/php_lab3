<?php

namespace API\Studio;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudioPatchTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_patch_studio_200(): void
    {
        $studioData = [
            'name' => 'My Studio',
            'year_of_foundation' => "2000-01-01",
            'active' => true,
            'description' => 'Lorem ipsum dolor sit amet',
        ];

        $response = $this->patch('/api/v1/studios/44', $studioData);

        $response->assertStatus(200);
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

    public function test_patch_studio_422_byInvalid(): void
    {
        $studioData = [
            'name' => 'My Studio Test',
            'year_of_foundation' => "2000-01",
        ];

        $response = $this->patch('/api/v1/studios/48', $studioData);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the studio exists in the database
        $this->assertDatabaseMissing('studios', [
            'name' => $studioData['name'],
        ]);
    }

    public function test_patch_studio_404_byId(): void
    {
        $studioData = [
            'name' => 'My Studio Test Patch',
            'year_of_foundation' => "2000-01-01",
        ];

        $response = $this->patch('/api/v1/studios/1000', $studioData);

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'errors'
        ]);

        // Assert that the studio exists in the database
        $this->assertDatabaseMissing('studios', [
            'name' => $studioData['name'],
        ]);
    }
}
