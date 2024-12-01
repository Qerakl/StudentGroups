<?php

namespace Tests\Feature\Student;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index()
    {
        Student::factory()->create();
        $response = $this->get(route('student.index'));


        $response->assertStatus(200);
        $this->assertDatabaseCount('students', 1);

    }
}
