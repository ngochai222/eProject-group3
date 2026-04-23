<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SeatController;
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
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\SeatController as AdminSeatController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\PricingController as AdminPricingController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\TicketBuyController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdmin\TaskController as SuperAdminTaskController;

// Public
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/cinema', [CinemaController::class, 'index'])->name('cinema');
Route::get('/movie/{index}', [MovieController::class, 'detail'])->name('movie.detail');
Route::get('/showtime-detail/{id}', [MovieController::class, 'showtimeDetail'])->name('showtime.detail');
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/all-movies', [MovieController::class, 'allMovies'])->name('movies.all');
Route::get('/coming-soon', [MovieController::class, 'comingSoon'])->name('coming-soon');
Route::get('/showtime', [MovieController::class, 'showtime'])->name('showtime');
Route::get('/tickets/buy', [TicketBuyController::class, 'buy'])->name('tickets.buy');
Route::get('/tickets/seat', [TicketBuyController::class, 'seat'])->name('tickets.seat');
Route::post('/tickets/confirm', [TicketBuyController::class, 'confirm'])->name('tickets.confirm');

Route::middleware('auth:customer')->group(function () {
    Route::get('/my-tickets', [TicketBuyController::class, 'myTickets'])->name('tickets.my');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Auth
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [ForgotpwController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotpwController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::prefix('superadmin')->group(function () {
    Route::get('/login', [SuperAdminController::class, 'showLogin'])->name('superadmin.login');
    Route::post('/login', [SuperAdminController::class, 'login'])->name('superadmin.login.post');
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
        Route::get('/managers', [SuperAdminController::class, 'managerIndex'])->name('superadmin.managers.index');
        Route::get('/managers/create', [SuperAdminController::class, 'managerCreate'])->name('superadmin.managers.create');
        Route::post('/managers', [SuperAdminController::class, 'managerStore'])->name('superadmin.managers.store');
        Route::get('/managers/{id}/edit', [SuperAdminController::class, 'managerEdit'])->name('superadmin.managers.edit');
        Route::put('/managers/{id}', [SuperAdminController::class, 'managerUpdate'])->name('superadmin.managers.update');
        Route::delete('/managers/{id}', [SuperAdminController::class, 'managerDestroy'])->name('superadmin.managers.destroy');
        Route::get('/tasks', [SuperAdminTaskController::class, 'index'])->name('superadmin.tasks.index');
        Route::post('/tasks', [SuperAdminTaskController::class, 'store'])->name('superadmin.tasks.store');
        Route::delete('/tasks/{id}', [SuperAdminTaskController::class, 'destroy'])->name('superadmin.tasks.destroy');    });
});

// Managers panel (was admin)
Route::prefix('managers')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [ManagerController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware('manager.auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::patch('/tasks/{id}/status', [SuperAdminTaskController::class, 'updateStatus'])->name('tasks.status');
        Route::resource('movies', AdminMovieController::class);
        Route::resource('showtimes', ShowtimeController::class);
        Route::resource('reviews', ReviewController::class);
        Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/{id}', [AdminCustomerController::class, 'show'])->name('customers.show');
        Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
        Route::delete('/tickets/{id}', [AdminTicketController::class, 'destroy'])->name('tickets.destroy');
        Route::get('/pricing', [AdminPricingController::class, 'index'])->name('pricing.index');
        Route::put('/pricing', [AdminPricingController::class, 'update'])->name('pricing.update');
        Route::get('/seats', [AdminSeatController::class, 'index'])->name('seats.index');
        Route::get('/seats/rooms', function() {
            return response()->json(\DB::table('rooms')->where('cinema_id', request('cinema_id'))->get(['id','name']));
        })->name('seats.rooms');
        Route::post('/seats/generate', [AdminSeatController::class, 'generate'])->name('seats.generate');
        Route::patch('/seats/{id}', [AdminSeatController::class, 'updateType'])->name('seats.update');
        Route::delete('/seats/{id}', [AdminSeatController::class, 'destroy'])->name('seats.destroy');
        Route::get('/promotions', [AdminPromotionController::class, 'index'])->name('promotions.index');
        Route::post('/promotions', [AdminPromotionController::class, 'store'])->name('promotions.store');
        Route::delete('/promotions/{id}', [AdminPromotionController::class, 'destroy'])->name('promotions.destroy');
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::resource('manager-accounts', ManagerController::class);
        Route::get('/cinemas', [AdminCinemaController::class, 'index'])->name('cinemas.index');
        Route::get('/cinemas/create', [AdminCinemaController::class, 'create'])->name('cinemas.create');
        Route::post('/cinemas', [AdminCinemaController::class, 'store'])->name('cinemas.store');
        Route::get('/cinemas/{id}/edit', [AdminCinemaController::class, 'edit'])->name('cinemas.edit');
        Route::put('/cinemas/{id}', [AdminCinemaController::class, 'update'])->name('cinemas.update');
        Route::delete('/cinemas/{id}', [AdminCinemaController::class, 'destroy'])->name('cinemas.destroy');
        Route::get('/rooms', function() {
            return response()->json(\DB::table('rooms')->where('cinema_id', request('cinema_id'))->get(['id', 'name']));
        });
    });
});
