<?php

namespace Tests\Feature\Group;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * Тест успешного создания группы.
     */
    public function test_store_creates_group_successfully()
    {
        $name = $this->faker->name();
        $response = $this->post(route('group.store'), [
            'name' => $name,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('groups', [
            'name' => $name,
        ]);
    }
}
