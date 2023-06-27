<?php

use App\Http\Controllers\SimpatisanController;
use App\Http\Controllers\TpsController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::name('tps.')->prefix('tps')->group(function(){
        Route::view('/', 'tps.index')->name('index');
        Route::view('create', 'tps.create')->name('create');
        Route::get('store', [TpsController::class, 'store'])->name('store');
        Route::get('destroy',[TpsController::class,'destroy'])->name('destroy');
        Route::get('edit', [TpsController::class, 'edit'])->name('edit');
        Route::get('update',[TpsController::class, 'update'])->name('update');
        Route::get('import', [TpsController::class, 'import'])->name('import');
    });

    Route::name('simpatisan.')->prefix('simpatisan')->group(function(){
        Route::view('/','simpatisan.index')->name('index');
        Route::view('create', 'simpatisan.create')->name('create');
        Route::get('store', [SimpatisanController::class,'store'])->name('store');
    });
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
