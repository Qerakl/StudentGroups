<?php

namespace Tests\Feature\Journal;

use App\Models\StudentSubject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного удаления оценки студента по предмету.
     */
    public function test_destroy_student_subject_successfully()
    {
        $this->artisan('db:seed');
        $studentSubject = StudentSubject::first();
        $response = $this->delete(route('journal.destroy', $studentSubject));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('student_subjects', [
            'student_id' => $studentSubject->student_id,
            'subject_id' => $studentSubject->subject_id,
        ]);
    }

    /**
     * Тест удаления несуществующего студентского предмета (404).
     */
    public function test_destroy_student_subject_not_found()
    {
        $response = $this->delete(route('journal.destroy', ['studentSubject' => 999]));
        $response->assertStatus(404);
    }
}
