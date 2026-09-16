<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:alumni'])->prefix('alumni')->name('alumni.')->group(function () {

    // Alumni Dashboard
    Route::get('/dashboard', [AlumniController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [AlumniController::class, 'profile'])->name('profile');

    // Help & FAQs
    Route::get('/help', [AlumniController::class, 'help'])->name('help');
});
