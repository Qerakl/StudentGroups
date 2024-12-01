<?php

namespace Tests\Feature\Student;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного обновления студента с корректными данными.
     */
    public function test_successful_update_student()
    {
        $student = Student::factory()->create([
            'login' => $this->faker->unique()->userName(),
        ]);

        $updatedData = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $this->faker->unique()->userName(),
        ];

        $response = $this->put(route('student.update', $student), $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'first_name' => $updatedData['first_name'],
            'last_name' => $updatedData['last_name'],
            'login' => $updatedData['login'],
        ]);
    }
}
