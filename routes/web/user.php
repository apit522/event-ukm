
<?php

use App\Http\Controllers\TrafficController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\UKMcontroller;
use Illuminate\Support\Facades\Route;

Route::controller(UKMcontroller::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/login', 'showLoginForm')->name('ukm.login');
        Route::post('/logout', 'logout')->name('ukm.logout');
        Route::get('/ukm/{id}', 'profile')->middleware('traffic');
        Route::post('/login', 'login');
        Route::middleware(['ukm'])->group(function () {
            Route::get('/dashboard', 'dashboard');
        });
    });

Route::controller(PostController::class)
    ->group(function () {
        Route::get('/post/{id}', 'index')->middleware('traffic');
    });

Route::controller(EventController::class)
    ->group(function () {
        Route::get('/checkout/{id}', 'checkout');
        Route::post('/form/checkout/{id}', 'submitCheckout');
    });

Route::controller(TrafficController::class)
    ->group(function () {
        Route::post('/share-ukm/{ukmId}', 'shareUkm');
        Route::post('/share-post/{postId}', 'sharePost');
    });
