<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Student::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try
        {
            $student = $request->validated();
            $student['password'] = Hash::make($student['password']);
            $student = Student::create($student);
            $student->group()->increment('count_students');

            return response()->json([$student,'message' => 'Student created'], 201);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        unset($student['password']);
        return response()->json($student);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        try
        {
            if($request->input('group_id') != $student->group()->first()->id){
                $student->group()->decrement('count_students');
                $student->update([
                    'group_id' => $request->input('group_id'),
                ]);
                $student->group()->increment('count_students');
            }
            $student->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'login' => $request->input('login'),
            ]);
            unset($student['password']);
            return response()->json([$student,'message' => 'Student updated'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->group()->decrement('count_students');
        $student->delete();
        return response()->json(['message' => 'Student deleted'], 200);
    }
}
