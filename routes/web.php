<?php

use Illuminate\Support\Facades\Route;

Route::get('/{vue_capture?}', function () {
    return view('auth.login');
})->where('vue_capture', '[\/\w\.-]*');


