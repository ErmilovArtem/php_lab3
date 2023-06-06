<?php

namespace API\Director;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DirectorDeliteTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_delete_director_204(): void
    {
        $response = $this->delete('/api/v1/directors/42');

        $response->assertStatus(204);

        // Assert that the director exists in the database
        $this->assertDatabaseHas('directors', [
            'id' => 44,
        ]);
    }

    public function test_delete_director_404_byId(): void
    {
        $response = $this->delete('/api/v1/directors/4200');

        $response->assertStatus(404);

        // Assert that the director exists in the database
        $this->assertDatabaseHas('directors', [
            'id' => 44,
        ]);
    }

}
