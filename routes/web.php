<?php

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

Route::get('/', [HomeController::class,'index'])->name('home');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::name('tps.')->prefix('tps')->group(function(){
        Route::view('/', 'tps.index')->name('index');
        Route::view('create', 'tps.create')->name('create');
        Route::get('store', [TpsController::class, 'store'])->name('store');
        Route::get('destroy',[TpsController::class,'destroy'])->name('destroy');
        Route::get('edit', [TpsController::class, 'edit'])->name('edit');
        Route::get('update',[TpsController::class, 'update'])->name('update');
        Route::get('import', [TpsController::class, 'import'])->name('import');
    });

    Route::resource('simpatisan', SimpatisanController::class);
    
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});
