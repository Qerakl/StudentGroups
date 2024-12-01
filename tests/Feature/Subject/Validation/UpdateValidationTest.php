<?php

namespace Tests\Feature\Subject\Validation;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateValidationTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * Тест валидации при обновлении — уникальность имени.
     */
    public function test_validation_name_is_unique_on_update()
    {
        $existingName = $this->faker->word;
        Subject::factory()->create(['name' => $existingName]);

        $subject = Subject::factory()->create();
        $response = $this->put(route('subject.update', $subject), [
            'name' => $existingName,
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Тест валидации — имя обязательно.
     */
    public function test_validation_name_is_required_on_update()
    {
        $subject = Subject::factory()->create();

        $response = $this->put(route('subject.update', $subject), [
            'name' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }
}
