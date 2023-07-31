<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('user')->group(function () {
        Route::apiResource('administrative', \App\Http\Controllers\AdministrativeController::class);
        Route::apiResource('doctor', \App\Http\Controllers\DoctorController::class);
    });

    Route::apiResource('user', \App\Http\Controllers\UserController::class);

    Route::prefix('auth')->controller(\App\Http\Controllers\AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
});
