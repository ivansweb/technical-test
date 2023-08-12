<?php

use App\Http\Controllers\{Auth\AuthController, DashboardController};
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class,'index'])->name('login');
Route::post('/signin', [AuthController::class,'signin'])->name('signin');
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
});
