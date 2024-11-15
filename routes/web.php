<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DashboardController;
use Rap2hpoutre\FastExcel\FastExcel;
use App\User;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;
Route::get('/', function () {
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

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
