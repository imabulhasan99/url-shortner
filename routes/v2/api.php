<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v2\UrlController;
use App\Http\Controllers\v2\AuthController;
use Illuminate\Support\Facades\Auth;


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class,'logout'])->name('logout');
        Route::prefix('url')->group(function () {
            Route::post('create', [UrlController::class,'store'])->name( 'url.store');
            Route::get('/list',[UrlController::class,'index']);
        });
});


Route::middleware('guest:sanctum')->group(function () {
    Route::post('register', [AuthController::class,'register'])->name('register');
    Route::post('login', [AuthController::class,'login'])->name('login');
});

