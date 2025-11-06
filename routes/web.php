<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\KartingController;
use Illuminate\Support\Facades\Route;

// Login
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Register
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// Home redirect
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('kartings.index');
    }
    return redirect()->route('login');
})->name('home');



// ✅ CRUD de Kartings protegido con auth
Route::middleware('auth')->group(function () {
    Route::resource('kartings', KartingController::class); // <-- ESTA LÍNEA ES CLAVE
});
