<?php

namespace Tests\Feature\Group\Validation;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест валидации при обновлении группы.
     */
    public function test_update_validation()
    {
        $group = Group::factory()->create();

        $response = $this->put(route('group.update', $group), [
            'name' => ''
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Тест уникальности имени при обновлении группы.
     */
    public function test_update_name_must_be_unique()
    {
        $existingGroup = Group::factory()->create();
        $groupToUpdate = Group::factory()->create();

        $response = $this->put(route('group.update', $groupToUpdate), [
            'name' => $existingGroup->name
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }
}
