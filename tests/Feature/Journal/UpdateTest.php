<?php

namespace Tests\Feature\Journal;

use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного обновления оценки студента по предмету.
     */
    public function test_update_student_subject_successfully()
    {
        $this->artisan('db:seed');
        $studentSubject = StudentSubject::first();

        $studentSubject = StudentSubject::where('student_id', $studentSubject->student_id)
            ->where('subject_id', $studentSubject->subject_id)
            ->first();

        $response = $this->put(route('journal.update', $studentSubject), [
            'grade' => 3,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'StudentSubject updated successfully',
        ]);
        $response->assertJsonFragment([
            'grade' => 3,
        ]);
    }

    /**
     * Тест на 404 ошибку.
     */
    public function test_destroy_student_subject_not_found()
    {
        $response = $this->put(route('journal.update', 9999), [
            'grade' => 3,
        ]);

        $response->assertStatus(404);
    }
}
