<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // Index
    Route::get('/', fn () => view('reports'))->name('index');
});
