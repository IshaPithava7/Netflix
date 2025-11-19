<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\VideoController;

// All admin routes

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('/users/list', [AdminController::class, 'users'])->name('users');

// Users (full CRUD)
Route::resource('users', UserController::class);

// Manage Videos (CRUD)
Route::resource('videos', VideoController::class);

Route::get('/main_dashboard', [AdminController::class, 'main_dashboard'])->name('main_dashboard');

