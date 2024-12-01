<?php

namespace Tests\Feature\Student\Validation;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    /**
     * Тест валидации обязательных полей.
     */
    public function test_validation_required_fields()
    {
        $response = $this->post(route('student.store'), [
            'first_name' => '',
            'last_name' => '',
            'login' => '',
            'password' => '',
            'group_id' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['first_name', 'last_name', 'login', 'password', 'group_id']);
        $this->assertDatabaseCount('students', 0);
    }

    /**
     * Тест валидации уникальности логина.
     */
    public function test_validation_unique_login()
    {
        $group = Group::factory()->create();
        $student = Student::create([
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $this->faker->unique()->userName(),
            'group_id' => $group->id,
            'password' => 'password',
        ]);

        $response = $this->post(route('student.store'), [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $student->login, // Старая уникальная запись
            'group_id' => $group->id,
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
        $group = Group::factory()->create();
        $response = $this->post(route('student.store'), [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $this->faker->unique()->userName(),
            'group_id' => $group->id,
            'password' => '123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
        $this->assertDatabaseCount('students', 0);
    }

    /**
     * Тест валидации несуществующая группа.
     */
    public function test_store_student_with_nonexistent_group()
    {
        $response = $this->post(route('student.store'), [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'login' => $this->faker->unique()->userName(),
            'group_id' => 999999, // Несуществующий ID группы
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['group_id']);
    }

}
