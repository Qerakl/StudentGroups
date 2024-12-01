<?php

namespace Tests\Feature\Subject;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест успешного получения списка предметов.
     */
    public function test_can_fetch_all_subjects()
    {
        Subject::factory()->count(5)->create();

        $response = $this->get(route('subject.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }
}
