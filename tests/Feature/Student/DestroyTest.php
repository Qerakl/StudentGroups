<?php

namespace Tests\Feature\Student;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_destroy(){
        $student = Student::factory()->create();
        $response = $this->delete(route('student.destroy', $student));

        $response->assertStatus(200);
    }
}
