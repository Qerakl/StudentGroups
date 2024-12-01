<?php

namespace Tests\Feature\Subject;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного создания предмета.
     */
    public function test_can_store_subject()
    {
        $name = $this->faker->word;

        $response = $this->post(route('subject.store'), [
            'name' => $name,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('subjects', [
            'name' => $name,
        ]);
    }
}
