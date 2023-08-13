<?php

use App\Http\Controllers\{Auth\AuthController, DashboardController, FarmController};
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class,'index'])->name('login');
Route::post('/signin', [AuthController::class,'signin'])->name('signin');
Route::get('/signout', [AuthController::class,'signout'])->name('signout');
Route::get('/register', [AuthController::class, 'create'])->name('user.create');
Route::post('/user/new', [AuthController::class, 'store'])->name('user.store');

Route::group(['middleware' => 'auth:sanctum'], function() {
    /**
     * Auth
     */
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('me', [AuthController::class, 'me'])->name('me');

    /**
     * Dashboard
     */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Registers
     */
    Route::group(['prefix' => 'registers'], function () {
        /**
         * farms
         */
        Route::group(['prefix' => 'farms'], function () {
            Route::get('/', [FarmController::class, 'index'])->name('farms.list');
            Route::get('/new', [FarmController::class, 'create'])->name('farms.new');
            Route::post('/', [FarmController::class, 'store'])->name('farms.store');
            Route::get('/edit/{id}', [FarmController::class, 'show'])->name('farms.show');
            Route::put('/edit/{id}', [FarmController::class, 'update'])->name('farms.update');
        });
    });


});
