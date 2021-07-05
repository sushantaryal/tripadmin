<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::post('login', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'store']);
Route::post('register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'show']);

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::put('password', [\Laravel\Fortify\Http\Controllers\PasswordController::class, 'update']);
        Route::put('profile-information', [\Laravel\Fortify\Http\Controllers\ProfileInformationController::class, 'update']);
    });

    Route::post('logout', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'destroy']);
});
