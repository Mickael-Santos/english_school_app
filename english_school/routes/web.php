<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\AuthController;

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register/store', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login/auth', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [StudentClassController::class, 'index'])->middleware('auth');

Route::get('/tutors', [TutorController::class, 'index'])->middleware('auth');
Route::get('/tutors/create', [TutorController::class, 'create'])->middleware('auth');
Route::post('/tutors/store', [TutorController::class, 'store'])->middleware('auth');
Route::get('/tutors/edit/{id}', [TutorController::class, 'edit'])->middleware('auth');
Route::put('/tutors/update/{id}', [TutorController::class, 'update'])->middleware('auth');

