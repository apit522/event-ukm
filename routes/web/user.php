
<?php

use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\UKMcontroller;
use Illuminate\Support\Facades\Route;

Route::controller(UKMcontroller::class)
    ->group(function () {
        Route::get('/', 'index');
    });

Route::controller(PostController::class)
    ->group(function () {
        Route::get('/post/{id}', 'index');
    });

Route::controller(EventController::class)
    ->group(function () {
        Route::get('/checkout/{id}', 'checkout');
        Route::post('/form/checkout/{id}', 'submitCheckout');
    });
