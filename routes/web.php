<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthenticatedUserController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('register', [RegistrationController::class, 'create'])->name('register');
Route::post('register', [RegistrationController::class, 'Register']);
Route::get('login', [AuthenticatedUserController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedUserController::class, 'Login']);
