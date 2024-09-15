<?php

use App\Http\Controllers\Records\StoreCheckInController;
use App\Http\Controllers\Records\StoreCheckOutController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // Index
    Route::get('/', fn () => view('records'))->name('index');

    // Register Attendance Entrance
    Route::post('/check-in', StoreCheckInController::class)->name('check-in');

    // Register Attendance Exit
    Route::patch('/check-out', StoreCheckOutController::class)->name('check-out');
});
