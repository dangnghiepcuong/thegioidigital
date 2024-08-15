<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('trang-chu');
})->name('homepage');
