<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
Route::get('/', function () {
    return \App\Models\Store::all();
    return view('login');
});
Route::get('/register', function () {
    return view('register');
})->name('register');

// routes/web.php
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('/packages/export', [PackageController::class, 'export'])->name('packages.export');

