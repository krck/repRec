<?php

use App\Http\Middleware\RoleAccessMiddleware as Roles;
use App\Http\Controllers\ExerciseCategoryController;
use App\Http\Controllers\AdminSelectionController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('training-week');
});

// --------------------------------------------------------------------------
// -------------- ADMIN ROUTES  (require AUTH and ROLE ADMIN) ---------------
// --------------------------------------------------------------------------
Route::middleware(['auth', Roles::class . ':admin'])->group(function () {
    // Error Logs
    Route::controller(LogController::class)->group(function () {
        Route::get('/admin-logs/{filterType}', 'index')->name('admin.logs');
    });
    // User Roles
    Route::controller(UserRoleController::class)->group(function () {
        Route::get('/admin-userroles', 'index')->name('admin.userroles');
    });
    // System Selections (Exercise Categories, Exercises, etc.)
    Route::controller(AdminSelectionController::class)->group(function () {
        Route::get('/admin-selections', 'index')->name('admin.selections');
    });
    Route::controller(ExerciseCategoryController::class)->group(function () {
        Route::get('/exercise-category', 'index')->name('exercise-category.index');
        Route::get('/exercise-category/create', 'create')->name('exercise-category.create');
        Route::post('/exercise-category', 'store')->name('exercise-category.store');
        Route::get('/exercise-category/{exerciseCategory}/edit', 'edit')->name('exercise-category.edit');
        Route::patch('/exercise-category/{exerciseCategory}', 'update')->name('exercise-category.update');
        Route::delete('/exercise-category/{id}', 'destroy')->name('exercise-category.destroy');
    });
    Route::controller(ExerciseController::class)->group(function () {
        Route::get('/exercise', 'index')->name('exercise.index');
        Route::get('/exercise/create', 'create')->name('exercise.create');
        Route::post('/exercise', 'store')->name('exercise.store');
        Route::get('/exercise/{exercise}/edit', 'edit')->name('exercise.edit');
        Route::patch('/exercise/{exercise}', 'update')->name('exercise.update');
        Route::delete('/exercise/{id}', 'destroy')->name('exercise.destroy');
    });
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
