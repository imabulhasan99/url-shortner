<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v2\UrlController;

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
Route::get("/{shorturl}", [UrlController::class,'redirect'])->name('url.redirect');
