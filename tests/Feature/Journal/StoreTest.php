<?php

namespace Tests\Feature\Journal;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * Тест успешного создания записи в журнале.
     */
    public function test_store_creates_student_subject_successfully()
    {
        $student = Student::factory()->create();
        $subject = Subject::factory()->create();

        $response = $this->post(route('journal.store'), [
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'grade' => (string) fake()->numberBetween(2, 5),
            'date' => now()->format('Y-m-d'),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('student_subjects', [
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'grade' => $response->original['grade'],
            'date' => date('Y-m-d'),
        ]);
    }
}
