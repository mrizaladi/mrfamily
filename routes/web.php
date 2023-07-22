<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimpatisanController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::controller(RegisterController::class)->group(function () {
    Route::get('regdistrict/{id}', 'regdistrict')->name('regdistrict');
    Route::get('regsubdistrict/{id}', 'regsubdistrict')->name('regsubdistrict');
});

Route::middleware('auth')->group(function () {
    Route::controller(SimpatisanController::class)->group(function() {
        Route::get('district/{id}', 'district')->name('district');
        Route::get('subdistrict/{id}', 'subdistrict')->name('subdistrict');
    });

    Route::get('users', [UserController::class, 'index'])->middleware('role:superadmin')->name('users.index');
    Route::resource('tps', TpsController::class);
    Route::resource('simpatisan', SimpatisanController::class);
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'show')->name('profile.show');
        Route::put('profile', 'update')->name('profile.update');
    });
});
