<?php

use App\Http\Controllers\HandleNotAuthController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\NoAuth;
use Illuminate\Support\Facades\Route;

Route::middleware(HandleInertiaRequests::class)->group(function() {
    Route::middleware(NoAuth::class)->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('rooms');

        Route::resource('/rooms', RoomController::class)->only('store', 'show');
    });

    Route::resource('/setup', HandleNotAuthController::class)->only('index', 'store');
});
