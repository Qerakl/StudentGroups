<?php

namespace Tests\Feature\Student;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного удаления студента.
     */
    public function test_destroy_deletes_student_successfully(){
        $student = Student::factory()->create();
        $response = $this->delete(route('student.destroy', $student));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('students', [
            'id' => $student->id
        ]);
    }
    /**
     * Тест успешного удаления студента и проверка декримента в группе после его удаления.
     */
    public function test_destroy_deletes_student_successfully_and_check_decrement(){
        $this->artisan('db:seed');
        $group = Group::first();
        $student = $group->students()->first();

        $response = $this->delete(route('student.destroy', $student));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('students', [
            'id' => $student->id
        ]);
        $this->assertDatabaseHas('groups', [
            'id' => $group->id,
            'count_students' => $group->count_students - 1,
        ]);
    }
}
