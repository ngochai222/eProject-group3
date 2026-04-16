<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotpwController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\BookingController;


Route::get('/', [MovieController::class, 'index']);

// Commented out - views and models need to be created first
// Route::resource('tickets', TicketController::class);
// Route::resource('seats', SeatController::class);
// Route::resource('employees', EmployeesController::class);

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/forgot-password', [ForgotpwController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotpwController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/showtime', [ShowtimeController::class, 'index'])->name('showtime');
Route::get('/booking', [BookingController::class, 'index'])->name('booking');