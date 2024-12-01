<?php

namespace Tests\Feature\Group\Validation;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест валидации при создании группы с пустым именем.
     */
    public function test_store_validation()
    {
        // Невалидные данные
        $response = $this->post(route('group.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Тест уникальности имени при создании группы.
     */
    public function test_store_name_must_be_unique()
    {
        $existingGroup = Group::factory()->create();

        $response = $this->post(route('group.store'), ['name' => $existingGroup->name]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }
}
