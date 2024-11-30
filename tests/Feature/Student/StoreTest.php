<?php

namespace Tests\Feature\Student;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;


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

}
