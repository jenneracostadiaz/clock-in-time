<?php

use Illuminate\Support\Facades\Route;

Route::any('/register', fn () => redirect('login'))->name('register.disabled');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/records', function () {
        return view('records');
    });
    Route::get('/reports', function () {
        return view('reports');
    });
});
