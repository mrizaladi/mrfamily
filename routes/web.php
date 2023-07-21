<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimpatisanController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\UserController;
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
Route::get('regdistrict/{id}', [RegisterController::class, 'regdistrict'])->name('regdistrict');
Route::get('regsubdistrict/{id}', [RegisterController::class, 'regsubdistrict'])->name('regsubdistrict');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::resource('tps', TpsController::class);
    Route::resource('simpatisan', SimpatisanController::class);
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'show')->name('profile.show');
        Route::put('profile', 'update')->name('profile.update');
    });
});
