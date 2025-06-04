<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Signup Routes
Route::get('/signup', [UserController::class, 'create'])->name('signupgo');
Route::post('/signup', [UserController::class, 'store'])->name('signup');

// Login Routes
Route::get('/login', function () {
    return view('register.login');
})->name('logingo');
Route::post('/login', [UserController::class, 'login'])->name('login');

// Route::get('/tasks', function () {
//     return view('task');
// })->name('task');


// For the main page, allowing an optional section parameter
Route::get('/tasks/{section?}', [TaskController::class, 'index'])
    ->where('section', '(today|all|add|settings)') // Validate section
    ->name('index');

Route::post('/tasks/store-ajax', [TaskController::class, 'store'])->name('store');
