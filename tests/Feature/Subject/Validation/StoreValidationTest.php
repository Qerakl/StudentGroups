<?php

namespace Tests\Feature\Subject\Validation;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreValidationTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * Тест валидации на обязательное поле.
     */
    public function test_validation_name_is_required()
    {
        $response = $this->post(route('subject.store'), [
            'name' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Тест валидации на уникальность имени.
     */
    public function test_validation_name_is_unique()
    {
        $name = $this->faker->word;
        Subject::factory()->create(['name' => $name]);

        $response = $this->post(route('subject.store'), [
            'name' => $name,
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }
}
