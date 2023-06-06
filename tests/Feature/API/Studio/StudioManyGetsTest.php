<?php

namespace API\Studio;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StudioManyGetsTest extends TestCase
{
    use DatabaseTransactions; // Если вы используете базу данных, для обновления БД после каждого теста

    public function test_getAll_studio_200(): void
    {
        $response = $this->get('/api/v1/studios/getById/42');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_active_studio_200(): void
    {
        $response = $this->get('/api/v1/studios/getById/42');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_allByOrderNameAsc_studio_200(): void
    {
        $response = $this->get('/api/v1/studios/getById/42');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_allByOrderNameDesc_studio_200(): void
    {
        $response = $this->get('/api/v1/studios/getById/42');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_allByOrderDateAsc_studio_200(): void
    {
        $response = $this->get('/api/v1/studios/getById/42');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }

    public function test_get_allByOrderDateDesc_studio_200(): void
    {
        $response = $this->get('/api/v1/studios/getById/42');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data');
        });
    }
}
