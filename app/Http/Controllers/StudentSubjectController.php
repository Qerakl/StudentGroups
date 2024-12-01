<?php

namespace App\Http\Controllers;

use App\Models\StudentSubject;
use App\Http\Requests\StoreStudentSubjectRequest;
use App\Http\Requests\UpdateStudentSubjectRequest;

class StudentSubjectController extends Controller
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
    public function show(StudentSubject $studentSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentSubject $studentSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentSubjectRequest $request, StudentSubject $studentSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentSubject $studentSubject)
    {
        //
    }
}
