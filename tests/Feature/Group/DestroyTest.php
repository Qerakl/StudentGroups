<?php

namespace Tests\Feature\Group;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного удаления группы.
     */
    public function test_destroy_deletes_group_successfully()
    {
        $group = Group::factory()->create();

        $response = $this->delete(route('group.destroy', $group));

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Group deleted']);

        $this->assertDatabaseMissing('groups', ['id' => $group->id]);
    }

    /**
     * Тест удаления несуществующей группы (404).
     */
    public function test_destroy_returns_404_for_nonexistent_group()
    {
        $response = $this->delete(route('group.destroy', 9999));
        $response->assertStatus(404);
    }
}
