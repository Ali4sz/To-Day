<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Signup Routes
Route::get('/signup', [UserController::class, 'create'])->middleware('guest')->name('signupgo');
Route::post('/signup', [UserController::class, 'store'])->middleware('guest')->name('signup');

// Login Routes
Route::get('/login', function () {
    return view('register.login');
})->middleware('guest')->name('logingo');
Route::post('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::post('/tasks/settings', [UserController::class, 'logout'])->middleware('auth')->name('logout');

// Route::get('/tasks', function () {
//     return view('task');
// })->name('task');


// For the main page, allowing an optional section parameter
Route::get('/tasks/{section?}', [TaskController::class, 'index'])
    ->where('section', '(today|all|add|settings)') // Validate section
    ->middleware('auth')->name('index');

Route::post('/tasks/store-ajax', [TaskController::class, 'store'])->middleware('auth')->name('store');

Route::delete('account/delete', [UserController::class, 'destroy'])->middleware('auth')->name('user.delete');
