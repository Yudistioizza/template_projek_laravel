<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MicrosoftController;

Route::get('/', function () {
    return view('welcome');  // Pastikan ada file resources/views/welcome.blade.php
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');  // Pastikan resources/views/dashboard.blade.php ada
    })->name('dashboard');
});

// Microsoft Login routes
Route::get('/login/microsoft', [MicrosoftController::class, 'redirectToMicrosoft'])->name('login.microsoft');
Route::get('/login/microsoft/callback', [MicrosoftController::class, 'handleMicrosoftCallback']);
