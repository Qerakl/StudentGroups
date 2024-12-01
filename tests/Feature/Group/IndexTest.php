<?php

namespace Tests\Feature\Group;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест успешного получения списка групп.
     */
    public function test_index_returns_paginated_groups()
    {
        Group::factory()->count(15)->create();

        $response = $this->get(route('group.index'));

        $response->assertStatus(200);
        $this->assertDatabaseCount('groups', 15);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'created_at', 'updated_at'],
            ],
        ]);
    }
}
