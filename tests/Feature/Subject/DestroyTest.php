<?php

namespace Tests\Feature\Subject;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест успешного удаления предмета.
     */
    public function test_can_delete_subject()
    {
        $subject = Subject::factory()->create();

        $response = $this->delete(route('subject.destroy', $subject));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('subjects', [
            'id' => $subject->id,
        ]);
    }

    /**
     * Тест на 404, если предмет не найден при удалении.
     */
    public function test_delete_returns_404_for_non_existing_subject()
    {
        $response = $this->delete(route('subject.destroy', 999));
        $response->assertStatus(404);
    }
}
