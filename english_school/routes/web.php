<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CustomUserController;
use App\Http\Controllers\StudentController;

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register/store', [AuthController::class, 'register']);

Route::get('/register/school', [SchoolController::class, 'register']);
Route::post('/schools/register/store/{id}', [SchoolController::class, 'store']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/auth', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [AuthController::class, 'login'])->middleware('auth');

Route::get('/custom_users', [CustomUserController::class, 'index'])->middleware('auth');
Route::get('/custom_users/create', [CustomUserController::class, 'create'])->middleware('auth');
Route::post('/custom_users/store', [CustomUserController::class, 'store'])->middleware('auth');
Route::get('/custom_users/edit/{id}', [CustomUserController::class, 'edit'])->middleware('auth');
Route::put('/custom_users/update/{id}', [CustomUserController::class, 'update'])->middleware('auth');
Route::get('/custom_users/delete/{id}', [CustomUserController::class, 'delete'])->middleware('auth');
Route::delete('/custom_users/delete/{id}', [CustomUserController::class, 'destroy'])->middleware('auth');
Route::get('/custom_users/show/{id}', [CustomUserController::class, 'show'])->middleware('auth');

Route::get('/students', [StudentController::class, 'index'])->middleware('auth');
Route::get('/students/create', [StudentController::class, 'create'])->middleware('auth');
Route::post('/students/store', [StudentController::class, 'store'])->middleware('auth');
Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->middleware('auth');
Route::put('/students/update/{id}', [StudentController::class, 'update'])->middleware('auth');
Route::get('/students/delete/{id}', [StudentController::class, 'delete'])->middleware('auth');
Route::delete('/students/delete/{id}', [StudentController::class, 'destroy'])->middleware('auth');
Route::get('/students/show/{id}', [StudentController::class, 'show'])->middleware('auth');


Route::get('/tutors', [TutorController::class, 'index'])->middleware('auth');
Route::get('/tutors/create', [TutorController::class, 'create'])->middleware('auth');
Route::post('/tutors/store', [TutorController::class, 'store'])->middleware('auth');
Route::get('/tutors/edit/{id}', [TutorController::class, 'edit'])->middleware('auth');
Route::put('/tutors/update/{id}', [TutorController::class, 'update'])->middleware('auth');
Route::get('/tutors/delete/{id}', [TutorController::class, 'delete'])->middleware('auth');
Route::delete('/tutors/delete/{id}', [TutorController::class, 'destroy'])->middleware('auth');
Route::get('/tutors/show/{id}', [TutorController::class, 'show'])->middleware('auth');

Route::get('/student_classes', [StudentClassController::class, 'index'])->middleware('auth');
Route::get('/student_classes/create', [StudentClassController::class, 'create'])->middleware('auth');
Route::post('/student_classes/store', [StudentClassController::class, 'store'])->middleware('auth');
Route::get('/student_classes/edit/{id}', [StudentClassController::class, 'edit'])->middleware('auth');
Route::put('/student_classes/update/{id}', [StudentClassController::class, 'update'])->middleware('auth');
Route::get('/student_classes/delete/{id}', [StudentClassController::class, 'delete'])->middleware('auth');
Route::delete('/student_classes/delete/{id}', [StudentClassController::class, 'destroy'])->middleware('auth');
Route::get('/student_classes/show/{id}', [StudentClassController::class, 'show'])->middleware('auth');
Route::post('/student_classes/addStudent/{id}', [StudentClassController::class, 'addStudent'])->middleware('auth');
Route::delete('/student_classes/removeStudent/{id}/{studentId}', [StudentClassController::class, 'removeStudent'])->middleware('auth');