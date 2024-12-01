<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('student', \App\Http\Controllers\StudentController::class)->except(['create', 'edit']);
Route::resource('group', \App\Http\Controllers\GroupController::class)->except(['create', 'edit']);
Route::resource('subject', \App\Http\Controllers\SubjectController::class)->except(['create', 'edit']);
Route::resource('journal', \App\Http\Controllers\JournalController::class)->except(['show', 'create', 'edit', 'update', 'destroy']);
Route::get('journal/group/{group}', [\App\Http\Controllers\JournalController::class, 'show_group'])->name('journal.show_group');
Route::put('journal/{studentSubject}', [\App\Http\Controllers\JournalController::class, 'update']);
Route::delete('journal/{studentSubject}', [\App\Http\Controllers\JournalController::class, 'destroy']);
