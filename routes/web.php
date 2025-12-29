<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/home', function () {
    return view('Home');
})->name('home');

Route::post('/auth', [AuthorizationController::class, 'handleAuthentication'])->name('auth.handle');
Route::post('/logout', [AuthorizationController::class, 'logout'])->name('logout');
