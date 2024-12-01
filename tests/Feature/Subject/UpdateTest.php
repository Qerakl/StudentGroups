<?php

namespace Tests\Feature\Subject;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного обновления предмета.
     */
    public function test_can_update_subject()
    {
        $subject = Subject::factory()->create();
        $name = $this->faker->word;

        $response = $this->put(route('subject.update', $subject), [
            'name' => $name,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('subjects', [
            'id' => $subject->id,
            'name' => $name,
        ]);
    }

    /**
     * Тест на 404, если предмет не найден при обновлении.
     */
    public function test_update_returns_404_for_non_existing_subject()
    {
        $name = $this->faker->word;

        $response = $this->put(route('subject.update', 999), [
            'name' => $name,
        ]);
        $response->assertStatus(404);
    }
}
