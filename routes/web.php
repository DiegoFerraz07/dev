<?php

use Illuminate\Support\Facades\Route;

Route::get('{pathMatch}', function () {
    return view('auth.login');
})->where('pahtMatch', '.*');

