<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\EmployeesController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('tickets', TicketController::class);
Route::resource('seats', SeatController::class);
Route::resource('employees', EmployeesController::class);