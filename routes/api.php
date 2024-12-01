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

Route::resource('student', \App\Http\Controllers\StudentController::class);
Route::resource('group', \App\Http\Controllers\GroupController::class);
Route::resource('subject', \App\Http\Controllers\SubjectController::class);
Route::resource('journal', \Database\Seeders\StudentSubjectSeeder::class);
