<?php

namespace API\Studio;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudioGetTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_get_studio_200(): void
    {
        $studioData = [
            'name' => 'My Studio',
            'year_of_foundation' => "2000-01-01",
            'active' => true,
            'description' => 'Lorem ipsum dolor sit amet',
        ];

        $this->patch('/api/v1/studios/42', $studioData);

        $response = $this->get('/api/v1/studios/getById/42');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'name' => 'My Studio',
            'year_of_foundation' => '2000-01-01',
            'active' => true,
            'description' => 'Lorem ipsum dolor sit amet',
        ]);
    }

    public function test_get_studio_404_byId(): void
    {
        $response = $this->get('/api/v1/studios/GetById/42');

        $response->assertStatus(404);
    }
}
