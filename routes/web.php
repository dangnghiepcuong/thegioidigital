<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRoleAdmin;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('trang-chu');
})->name('homepage');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware([CheckRoleAdmin::class])->controller(AdminController::class)
        ->group(function () {
            Route::get('/', 'index')->name('admin.index');

            Route::prefix('roles')->controller(RoleController::class)->group(function () {
                Route::get('{role_id?}', 'index')->name('admin.roles.index');
                Route::post('', 'store')->name('admin.roles.store');
            });
            Route::prefix('permissions')->group(function () {
                Route::get('{permission_id?}', 'index')->name('admin.permissions.index');
            });
        });

    Route::prefix('admin')->middleware([CheckRoleAdmin::class])
        ->group(function () {
            
        });

    Route::prefix('lich-su-mua-hang')->group(function () {
        Route::get('thong-tin-ca-nhan', [UserController::class, 'getPersonalInfo'])
            ->name('lich-su-mua-hang.thong-tin-ca-nhan');
    });

    // Resource routes
    Route::resource('lich-su-mua-hang', OrderController::class);

});
