<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\UrlController;
use App\Http\Controllers\v1\AuthController;
use Illuminate\Support\Facades\Auth;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

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

