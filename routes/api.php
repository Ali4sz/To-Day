<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('tasks/all', [TaskController::class, 'getAllTasksData'])->name('tasks.all.data');
Route::get('tasks/{task}', [TaskController::class, 'getAllTasksData'])->name('tasks.edit.data');
Route::get('tasks/today', [TaskController::class, 'getTodaysTasksData'])->name('tasks.today.data');

Route::patch('tasks/{task}/today', [TaskController::class, 'update'])->name('tasks.today.update');
Route::patch('tasks/{task}/edit', [TaskController::class, 'editTask'])->name('tasks.edit');


Route::delete('tasks/{task}/delete', [TaskController::class, 'destroy'])->name('tasks.today.destroy');
