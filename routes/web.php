<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TicketController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotpwController;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\AdminController;

// Trang chủ
Route::get('/', [MovieController::class, 'index'])->name('home');

// Public pages
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::view('/cinemas', 'cinemas')->name('cinemas');
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/showtimes', [ShowtimeController::class, 'index'])->name('showtimes');
Route::view('/contact', 'contact')->name('contact');

// Authentication
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotpwController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotpwController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// User routes
Route::resource('tickets', TicketController::class);
Route::resource('seats', SeatController::class);
Route::resource('employees', EmployeesController::class);

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin auth
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/forgot-password', [ForgotpwController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotpwController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    // Movies (ADMIN)
    Route::resource('movies', AdminMovieController::class);

    // Showtimes (ADMIN)
    Route::resource('showtimes', ShowtimeController::class);

    // Reviews (ADMIN)
    Route::resource('reviews', ReviewController::class);

    // Test
    Route::get('/test', function () {
        return "ADMIN OK";
    });
});
