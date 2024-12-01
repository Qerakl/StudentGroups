<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Http\Requests\StoreStudentSubjectRequest;
use App\Http\Requests\UpdateStudentSubjectRequest;
use App\Models\Subject;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journal  = StudentSubject::query()
        ->orderBy('date', 'desc')
        ->paginate(20);

        return response()->json($journal);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentSubjectRequest $request)
    {
        try {
            $studentSubject = $request->validated();
            $studentSubject['date'] = date('Y-m-d');
            StudentSubject::query()->create($studentSubject);

            return response()->json($studentSubject, 201);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show_group(Group $group)
    {
        $students = $group->students()->get();
        $journal  = [];
        $i = 0;
        foreach($students as $student) {
            $journal[$i] = StudentSubject::query()->where('student_id', $student->id)->get();
            $i++;
        }
        return response()->json($journal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentSubjectRequest $request, StudentSubject $studentSubject)
    {
        try {
            $studentSubject->update($request->validated());

            return response()->json([$studentSubject,'message' => 'StudentSubject updated successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentSubject $studentSubject)
    {
        $studentSubject->delete();

        return response()->json(null, 204);
    }
}
