<?php

use Illuminate\Support\Facades\Route;

Route::any('/register', fn () => redirect('login'))->name('register.disabled');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn () => view('dashboard'))->name('dashboard');
});

Route::prefix('reports')->as('reports:')->group(
    base_path('routes/resources/reports.php')
);

Route::prefix('records')->as('records:')->group(
    base_path('routes/resources/records.php')
);
