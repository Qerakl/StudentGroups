<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Subject::query()->count() === 0) {
            Subject::create([
                'name' => 'Русский язык'
            ]);
            Subject::create([
                'name' => 'Математика'
            ]);
            Subject::create([
                'name' => 'Физкультура'
            ]);
            Subject::create([
                'name' => 'Литература'
            ]);
            Subject::create([
                'name' => 'Астрономия'
            ]);
        }
    }
}
