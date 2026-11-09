<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/administratifcursor', function () {
    return view('admin');
});

Route::get('/logincursor', function () {
    return view('login');
});
