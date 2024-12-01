<?php

namespace Tests\Feature\Journal;

use App\Models\Student;
use App\Models\Group;
use App\Models\StudentSubject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowGroupTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест успешного получения журнала группы.
     */
    public function test_show_group_returns_students_journal_successfully()
    {
        $group = Group::factory()->create();
        $student1 = Student::factory()->create(['group_id' => $group->id]);
        $student2 = Student::factory()->create(['group_id' => $group->id]);
        $this->artisan('db:seed');

        $response = $this->getJson(route('journal.show_group', $group));
        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }
    /**
     * Тест на 404.
     */
    public function test_show_group_student_group_not_found()
    {
        $response = $this->getJson(route('journal.show_group', '9999'));
        $response->assertStatus(404);
    }
}
