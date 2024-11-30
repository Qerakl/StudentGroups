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


    //Проверка на успешное создание пользователя
    public function test_student_store()
    {
        $response = $this->post(route('student.store'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'login' => 'johndoeandpupkinvasiliy09203',
            'password' => 'password',
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('students', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'login' => 'johndoeandpupkinvasiliy09203',
        ]);
    }

}
