<?php

namespace Tests\Feature\Group;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного обновления группы.
     */
    public function test_update_updates_group_successfully()
    {
        $group = Group::factory()->create();
        $name = 'Updated Group';

        $response = $this->put(route('group.update', $group), [
            'name' => $name
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Group updated',
            'group' => ['name' => $name],
        ]);

        $this->assertDatabaseHas('groups',[
            'name' => $name
        ]);
    }

}
