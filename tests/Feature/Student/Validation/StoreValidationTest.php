<?php

namespace Tests\Feature\Student\Validation;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного создания студента с корректными данными.
     */
    public function test_validation_successful_student_creation()
    {
        $login = $this->faker->unique()->userName();
        $response = $this->post(route('student.store'), [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $login,
            'password' => 'password',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('students', [
            'login' => $login,
        ]);
    }

    /**
     * Тест валидации обязательных полей (first_name, last_name, login, password).
     */
    public function test_validation_required_fields()
    {
        $response = $this->post(route('student.store'), [
            'first_name' => '',
            'last_name' => '',
            'login' => '',
            'password' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['first_name', 'last_name', 'login', 'password']);
        $this->assertDatabaseCount('students', 0);
    }

    /**
     * Тест валидации уникальности логина.
     */
    public function test_validation_unique_login()
    {
        $student = Student::create([
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $this->faker->unique()->userName(),
            'password' => 'password',
        ]);

        $response = $this->post(route('student.store'), [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $student->login, // Старая уникальная запись
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['login']);
        $this->assertDatabaseCount('students', 1);
    }

    /**
     * Тест валидации минимальной длины пароля.
     */
    public function test_validation_password_min_length()
    {
        $response = $this->post(route('student.store'), [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $this->faker->unique()->userName(),
            'password' => '123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
        $this->assertDatabaseCount('students', 0);
    }
}
