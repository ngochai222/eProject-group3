<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotpwController;
use App\Http\Controllers\ProfileController;
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

Route::get("/", [MovieController::class, "index"])->name("home");
Route::get("/cinema", [MovieController::class, "cinema"])->name("cinema");

// Commented out - views and models need to be created first
// Route::resource("tickets", TicketController::class);
// Route::resource("seats", SeatController::class);
// Route::resource("employees", EmployeesController::class);

Route::get("/login", [LoginController::class, "showLogin"])->name("login");
Route::post("/login", [LoginController::class, "login"]);
Route::post("/logout", [LoginController::class, "logout"])->name("logout");

Route::get("/forgot-password", [ForgotpwController::class, "showForgotForm"])->name("password.request");
Route::post("/forgot-password", [ForgotpwController::class, "sendResetLinkEmail"])->name("password.email");

Route::get("/register", [RegisterController::class, "showRegister"])->name("register");
Route::post("/register", [RegisterController::class, "register"]);

Route::middleware("auth:customer")->group(function () {
    Route::get("/profile", [ProfileController::class, "profile"])->name("profile");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
});

// Admin Routes
Route::prefix("admin")->name("admin.")->group(function () {
    Route::get("/login", [AdminController::class, "showLogin"])->name("login");
    Route::post("/login", [AdminController::class, "login"]);
    Route::post("/logout", [AdminController::class, "logout"])->name("logout");
});