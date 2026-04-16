<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\MovieController;

use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\AdminController;

// Trang chủ
Route::get('/', [MovieController::class, 'index']);

// User routes
Route::resource('tickets', TicketController::class);
Route::resource('seats', SeatController::class);
Route::resource('employees', EmployeesController::class);

// ================= ADMIN =================
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    // Movies (ADMIN)
    Route::resource('movies', AdminMovieController::class);

    // Showtimes
    Route::resource('showtimes', ShowtimeController::class);

    // Reviews
    Route::resource('reviews', ReviewController::class);

    // Test
    Route::get('/test', function () {
        return "ADMIN OK";
    });

});