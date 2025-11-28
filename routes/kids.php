<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kids\HomeController;

Route::middleware(['auth'])->group(function () {
    Route::get('/kids', [HomeController::class, 'index'])->name('kids.home');
    Route::get('/kids/exit', [HomeController::class, 'exit'])->name('kids.exit');
});
