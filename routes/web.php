<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\Permission;
use App\Models\UserMeta;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('trang-chu');
})->name('homepage');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->controller(AdminController::class)
        ->group(function () {
            Route::get('/', 'index')->name('admin.index');

            Route::prefix('roles')->controller(RoleController::class)->group(function () {
                Route::get('{role_id?}', 'index')->name('admin.roles.index');
                Route::post('', 'store')->name('admin.roles.store');
            });
            Route::prefix('permissions')->controller(PermissionController::class)->group(function () {
                Route::get('grant-to-user/{user_id?}', 'grantToUser')
                    ->can('viewAny', UserMeta::class)
                    ->name('admin.permissions.grant-to-user');
                Route::get('getUserPermissionItems', 'getUserPermissionItems')
                    ->can('viewAny', UserMeta::class);
                Route::post('grant', 'grant')
                    ->can('create', Permission::class)
                    ->can('update', UserMeta::class)
                    ->name('admin.permissions.grant');
                Route::post('revoke/{permission_id}/users/{user_id}', 'revoke')
                    ->can('update', UserMeta::class)
                    ->name('admin.permissions.revoke');
                Route::get('/', 'index')
                    ->can('viewAny', Permission::class)
                    ->name('admin.permissions.index');
                Route::post('/', 'store')
                    ->can('create', Permission::class)
                    ->name('admin.permissions.store');
            });
        });

    Route::prefix('lich-su-mua-hang')->group(function () {
        Route::get('thong-tin-ca-nhan', [UserController::class, 'getPersonalInfo'])
            ->name('lich-su-mua-hang.thong-tin-ca-nhan');
    });

    // Resource routes
    Route::resource('lich-su-mua-hang', OrderController::class);
});
