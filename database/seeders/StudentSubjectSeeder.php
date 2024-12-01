<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $subjects = Subject::all();

        foreach ($students as $student) {
            foreach ($subjects as $subject) {

                StudentSubject::create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'grade' => (string) rand(2, 5),
                    'date' => fake()->dateTimeBetween('2023-01-01', '2025-01-01')->format('Y-m-d'),
                ]);
            }
        }
    }
}
