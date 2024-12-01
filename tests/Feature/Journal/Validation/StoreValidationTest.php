<?php

namespace Tests\Feature\Journal\Validation;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест на несуществующий student_id
     */
    public function test_invalid_student_id()
    {
        $subject = Subject::factory()->create();

        $response = $this->postJson(route('journal.store'), [
            'student_id' => 999,
            'subject_id' => $subject->id,
            'grade' => 3,
            'date' => '2024-12-01',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['student_id']);
    }

    /**
     * Тест на несуществующий subject_id
     */
    public function test_invalid_subject_id()
    {
        $student = Student::factory()->create();

        $response = $this->postJson(route('journal.store'), [
            'student_id' => $student->id,
            'subject_id' => 999,
            'grade' => 3,
            'date' => '2024-12-01',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['subject_id']);
    }

    /**
     * Тест на невалидную оценку grade
     */
    public function test_invalid_grade()
    {
        $student = Student::factory()->create();
        $subject = Subject::factory()->create();

        $response = $this->postJson(route('journal.store'), [
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'grade' => 6,  // Оценка больше 5
            'date' => '2024-12-01',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['grade']);
    }

    /**
     * Тест на невалидный формат даты
     */
    public function test_invalid_date_format()
    {
        $student = Student::factory()->create();
        $subject = Subject::factory()->create();

        $response = $this->postJson(route('journal.store'), [
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'grade' => 3,
            'date' => '2024-31-12',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['date']);
    }

    /**
     * Тест на отсутствие обязательных полей
     */
    public function test_missing_required_fields()
    {
        $response = $this->postJson(route('journal.store'), []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'student_id',
            'subject_id',
            'grade',
            'date'
        ]);
    }
}
