<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v2\UrlController;


    Route::get("/{shorturl}", [UrlController::class,'redirect'])->name('url.redirect');


