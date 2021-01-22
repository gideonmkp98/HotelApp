<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoomCategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified.admin']], function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('/users', 'App\Http\Controllers\Admin\UserController');
    Route::post('/delete-user', ['App\Http\Controllers\Admin\UserController','destroy']);
    Route::resource('/room-category', 'App\Http\Controllers\Admin\RoomCategoryController');
    Route::post('/delete-room-category', ['App\Http\Controllers\Admin\RoomCategoryController','destroy']);
    Route::resource('/rooms', 'App\Http\Controllers\Admin\RoomController');
    Route::post('/delete-room', ['App\Http\Controllers\Admin\RoomController','destroy']);
    Route::resource('/guests', 'App\Http\Controllers\Admin\GuestController');
    Route::post('/delete-guest', ['App\Http\Controllers\Admin\GuestController','destroy']);
    Route::resource('/reservations', 'App\Http\Controllers\Admin\ReservationController');
    Route::post('/delete-reservation', ['App\Http\Controllers\Admin\ReservationController','destroy']);
    Route::resource('/billings', 'App\Http\Controllers\Admin\BillingController');
    Route::post('/delete-billing', ['App\Http\Controllers\Admin\BillingController','destroy']);

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
