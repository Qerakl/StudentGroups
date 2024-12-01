<?php

namespace Tests\Feature\Group;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного получения данных о группе.
     */
    public function test_show_returns_group_data()
    {
        $group = Group::factory()->create();

        $response = $this->get(route('group.show', $group));

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $group->id,
            'name' => $group->name,
        ]);
    }
}
