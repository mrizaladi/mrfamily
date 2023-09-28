<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimpatisanController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

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
Route::controller(RegisterController::class)->group(function() {
    Route::post('createuser', 'createuser')->name('createuser');
    Route::get('regdistrict/{id}', 'regdistrict')->name('regdistrict');
    Route::get('regsubdistrict/{id}', 'regsubdistrict')->name('regsubdistrict');
    Route::get('approval', 'approval')->name('approval');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::middleware(['approved'])->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user_id}/approve', [UserController::class, 'approve'])->name('users.approve');
        Route::controller(SimpatisanController::class)->group(function(){
            Route::get('form', 'form')->name('simpatisan.form');
            Route::get('handleSelect', 'handleSelect')->name('handleselect');
            Route::get('subdistrict/{id}',  'subdistrict')->name('subdistrict');
            Route::get('district/{id}', 'district')->name('district');
            Route::get('approve', 'approve')->name('simpatisan.approve');
            Route::get('getDistrict', 'getDistrict')->name('getDistrict');
            Route::get('getSubDistrict', 'getSubDistrict')->name('getSubDistrict');
            Route::get('getSimpatisan', 'getSimpatisan')->name('getSimpatisan');
        });


        Route::resource('tps', TpsController::class);
        Route::resource('simpatisan', SimpatisanController::class);
        Route::get('get-data-simpatisan', [SimpatisanController::class,'getDataSimpatisan'])->name('getDataSimpatisan');//AJAX GET WITH QUERY
    });

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});
