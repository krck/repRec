<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('training-week');
});

// Admin Routes
Route::controller(LogController::class)->group(function () {
    Route::get('/admin-logs/{filterType}', 'index')->name('admin.logs');
});
Route::get('/admin-options', function () {
    return view('admin-options');
});
Route::get('/admin-userroles', function () {
    return view('admin-userroles');
});

// Planning Routes
Route::get('/plan-share', function () {
    return view('plan-share');
});
Route::get('/plan-workout', function () {
    return view('plan-workout');
});

// Training Routes
Route::get('/training-week', function () {
    return view('training-week');
});
Route::get('/training-year', function () {
    return view('training-year');
});
Route::get('/training-progress', function () {
    return view('training-progress');
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/user-info', function () {
    return view('user-info');
});
Route::get('/user-howto', function () {
    return view('user-howto');
});

require __DIR__ . '/auth.php';
