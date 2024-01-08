<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::controller(AdminController::class)
    ->group(function () {
        Route::get('/login', 'showLoginForm');
        Route::post('/login', 'login')->name('admin.login');
        Route::post('/logout', 'logout');
        Route::middleware(['admin'])->group(function () {
            Route::get('/dashboard', 'dashboard');
        });
    });
