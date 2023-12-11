
<?php

use App\Http\Controllers\User\UKMcontroller;
use Illuminate\Support\Facades\Route;

Route::controller(UKMcontroller::class)
    ->group(function () {
        Route::get('/', 'index');
    });
