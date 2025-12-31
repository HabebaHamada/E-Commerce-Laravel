<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\ProfileController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {return view('Home');})
    ->name('home');

    Route::get('/profile', function () {return view('Profile');})
    ->name('profile');

    Route::post('/logout', [AuthorizationController::class, 'logout'])
    ->name('logout');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


Route::post('/auth', [AuthorizationController::class, 'handleAuthentication'])->name('auth.handle');
