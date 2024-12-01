<?php

namespace Tests\Feature\Student;

use App\Models\Group;
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
        $this->artisan('db:seed');
        $oldGroup = Group::first();
        $newGroup = Group::factory()->create();
        $student = $oldGroup->students()->first();

        $response = $this->put(route('student.update', $student), [
            'first_name' => $first_name = $this->faker()->firstName(),
            'last_name' => $last_name = $this->faker()->lastName(),
            'login' => $login = $this->faker()->unique()->userName(),
            'group_id' => $newGroup->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'login' => $login,
            'group_id' => $newGroup->id,
        ]);
        $this->assertDatabaseHas('groups', [
            'id' => $newGroup->id,
            'count_students' => $newGroup->count_students + 1,
        ]);
        $this->assertDatabaseHas('groups', [
            'id' => $oldGroup->id,
            'count_students' => $oldGroup->count_students - 1,
        ]);
    }
}
