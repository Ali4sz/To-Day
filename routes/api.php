<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('tasks/all', [TaskController::class, 'getAllTasksData'])->name('tasks.all.data');
Route::get('tasks/today', [TaskController::class, 'getTodaysTasksData'])->name('tasks.today.data');
Route::get('tasks/{task}', [TaskController::class, 'edit'])->name('tasks.edit');


Route::patch('tasks/{task}/today', [TaskController::class, 'update'])->name('tasks.today.update');
// Route::patch('tasks/{task}/edit', [TaskController::class, 'editTask'])->name('tasks.edit');
Route::patch('tasks/{task}', [TaskController::class, 'editTask'])->name('tasks.editTask');


Route::delete('tasks/{task}/delete', [TaskController::class, 'destroy'])->name('tasks.today.destroy');
