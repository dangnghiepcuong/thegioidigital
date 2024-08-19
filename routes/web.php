<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('trang-chu');
})->name('homepage');

Route::middleware(['auth'])->group(function () {
    Route::prefix('lich-su-mua-hang')->group(function () {
        Route::get('thong-tin-ca-nhan', [UserController::class, 'getPersonalInfo'])
            ->name('lich-su-mua-hang.thong-tin-ca-nhan');
    });

    // Resource routes
    Route::resource('lich-su-mua-hang', OrderController::class);

});
