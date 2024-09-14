<?php

use App\Http\Controllers\Records\StoreCheckInController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // Index
    Route::get('/', fn () => view('records'))->name('index');

    // Register Attendance Entrance
    Route::post('/check-in', StoreCheckInController::class)->name('check-in');
});
