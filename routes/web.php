<?php

use App\Http\Controllers\web\BookingController;
use App\Http\Controllers\web\ServiceController;
use Illuminate\Support\Facades\Route;

Route::controller(ServiceController::class)
    ->name('services.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::prefix('services')->group(function () {
            Route::get('/{service}', 'show')->name('show');
        });
    });

Route::resource('bookings', BookingController::class)->only(['store']);
