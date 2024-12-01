<?php

namespace Tests\Feature\Student\Validation;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест ошибки при попытке обновления с уже существующим логином.
     */
    public function test_update_student_with_duplicate_login()
    {
        $existingStudent = Student::factory()->create([
            'login' => $this->faker->unique()->userName(),
        ]);

        $studentToUpdate = Student::factory()->create([
            'login' => $this->faker->unique()->userName(),
        ]);

        $response = $this->put(route('student.update', $studentToUpdate), [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $existingStudent->login,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['login']);
    }

    /**
     * Тест ошибки при попытке обновления с пустыми данными.
     */
    public function test_update_student_with_empty_data()
    {
        $student = Student::factory()->create();

        $response = $this->put(route('student.update', $student), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['first_name', 'last_name', 'login']);
    }
    /**
     * Тест ошибки при попытке обновления с некорректными типами данных.
     */
    public function test_update_student_with_invalid_data_types()
    {
        $student = Student::factory()->create();

        $response = $this->put(route('student.update', $student), [
            'first_name' => 123,
            'last_name' => true,
            'login' => ['array'],
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['first_name', 'last_name', 'login']);
    }
}
