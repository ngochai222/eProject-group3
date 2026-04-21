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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CinemaController as AdminCinemaController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\CinemaController;

// Public
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/cinema', [CinemaController::class, 'index'])->name('cinema');
Route::get('/movie/{index}', [MovieController::class, 'detail'])->name('movie.detail');
Route::get('/showtime-detail/{id}', [MovieController::class, 'showtimeDetail'])->name('showtime.detail');
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/coming-soon', [MovieController::class, 'comingSoon'])->name('coming-soon');
Route::get('/showtime', [MovieController::class, 'showtime'])->name('showtime');
Route::get('/admin/rooms', function() {
    $cinemaId = request('cinema_id');
    $rooms = \DB::table('rooms')->where('cinema_id', $cinemaId)->get(['id', 'name']);
    return response()->json($rooms);
});

// Auth
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotpwController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotpwController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Customer profile
Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('movies', AdminMovieController::class);
        Route::resource('showtimes', ShowtimeController::class);
        Route::resource('reviews', ReviewController::class);
        Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/{id}', [AdminCustomerController::class, 'show'])->name('customers.show');
        Route::get('/cinemas', [AdminCinemaController::class, 'index'])->name('cinemas.index');
        Route::get('/cinemas/create', [AdminCinemaController::class, 'create'])->name('cinemas.create');
        Route::post('/cinemas', [AdminCinemaController::class, 'store'])->name('cinemas.store');
        Route::get('/cinemas/{id}/edit', [AdminCinemaController::class, 'edit'])->name('cinemas.edit');
        Route::put('/cinemas/{id}', [AdminCinemaController::class, 'update'])->name('cinemas.update');
        Route::delete('/cinemas/{id}', [AdminCinemaController::class, 'destroy'])->name('cinemas.destroy');
    });
});
