<?php

namespace Tests\Feature\Student;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_show(){
        $student = Student::factory()->create();

        $response = $this->get(route('student.show', $student));
        $response->assertStatus(200);
    }

    public function test_show_not_found(){
        $response = $this->get(route('student.show', 'user'));
        $response->assertStatus(404);
    }
}
