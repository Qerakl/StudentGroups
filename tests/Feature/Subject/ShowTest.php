<?php

namespace Tests\Feature\Subject;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест успешного отображения предмета.
     */
    public function test_can_show_subject()
    {
        $subject = Subject::factory()->create();

        $response = $this->get(route('subject.show', $subject));

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => $subject->name]);
    }

    /**
     * Тест на 404, если предмет не найден.
     */
    public function test_show_returns_404_for_non_existing_subject()
    {
        $response = $this->get(route('subject.show', 999));

        $response->assertStatus(404);
    }
}
