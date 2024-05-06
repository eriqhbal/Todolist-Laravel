<?php


use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodolistController;
// Middleware
use App\Http\Middleware\GuestMiddlewareOnly;
use App\Http\Middleware\OnlyMemberMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'isExistUser']);

// View
Route::view('/template', 'template');

// Controllers
Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware([GuestMiddlewareOnly::class]);
    Route::post('/login', 'doLogin')->middleware([GuestMiddlewareOnly::class]);
    Route::post('/logout', 'doLogout')->middleware([OnlyMemberMiddleware::class]);
});

Route::controller(TodolistController::class)->middleware(OnlyMemberMiddleware::class)->group(function () {
    Route::get('/todolist', "getTodolist");
    Route::post('/todolist', 'saveTodolist');
    Route::post('/todolist/{id}/delete', 'deleteTodolist');
});
