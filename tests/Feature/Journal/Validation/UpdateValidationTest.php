<?php

namespace Tests\Feature\Journal\Validation;

use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест на обновление оценки в журнале с некорректной оценкой (выше максимальной).
     */
    public function test_invalid_grade_update()
    {
        $student = Student::factory()->create();
        $subject = Subject::factory()->create();

        $studentSubject = StudentSubject::create([
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'grade' => 4,
            'date' => '2024-12-01',
        ]);

        $response = $this->putJson(route('journal.update', $studentSubject), [
            'grade' => 6,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['grade']);
    }

    /**
     * Тест на обновление оценки в журнале с отсутствующим значением оценки.
     */
    public function test_missing_grade_update()
    {
        $student = Student::factory()->create();
        $subject = Subject::factory()->create();

        $studentSubject = StudentSubject::create([
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'grade' => 4,
            'date' => '2024-12-01',
        ]);

        $response = $this->putJson(route('journal.update', $studentSubject), [
            'grade' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['grade']);
    }

    /**
     * Тест на обновление оценки в журнале с неправильным типом данных (нечисловое значение).
     */
    public function test_invalid_grade_type_update()
    {
        $student = Student::factory()->create();
        $subject = Subject::factory()->create();

        $studentSubject = StudentSubject::create([
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'grade' => 4,
            'date' => '2024-12-01',
        ]);

        $response = $this->putJson(route('journal.update', $studentSubject), [
            'grade' => 'invalid',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['grade']);
    }


}
