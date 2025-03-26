<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Permission;
use App\Models\UserMeta;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('trang-chu');
})->name('homepage');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->controller(AdminController::class)->group(function () {
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

        Route::prefix('products')->controller(ProductController::class)->group(function () {
            Route::get('', 'index')->name('admin.products.index');
            Route::get('create', 'create')->name('admin.products.create');
            Route::post('', 'store')->name('admin.products.store');
            Route::get('{slug}/edit', 'edit')->name('admin.products.slug');
            Route::patch('{slug}/update', 'update')->name('admin.products.update');
            Route::post('{slug}/replicate', 'replicate')->name('admin.products.replicate');
            Route::get('card-view-by-data', 'getProductCardPreview');

            Route::prefix('files')->controller(FileController::class)->group(function () {
                Route::get('slider-images', 'getImagesForProductSlider');
                Route::post('description-images', 'uploadImagesForProductDescription');
                Route::post('slider-images', 'uploadImagesForProductSlider')
                    ->name('admin.products.slider.image');
                Route::delete('slider-images', 'deleteImagesFromProductSlider');
            });
        });
    });

    Route::prefix('lich-su-mua-hang')->group(function () {
        Route::get('thong-tin-ca-nhan', [UserController::class, 'getPersonalInfo'])
            ->name('lich-su-mua-hang.thong-tin-ca-nhan');
    });

    // Resource routes
    Route::resource('lich-su-mua-hang', OrderController::class);
});

Route::controller(ProductController::class)->group(function () {
    Route::get('dtdd/', 'dtdd')->name('products.dtdd');
    Route::get('dtdd/{slug}', 'show')->name('products.dtdd.slug');
    Route::get('dtdd-xiaomi/{slug?}', 'dtddXiaomi')->name('product.dtdd-xiaomi');
    Route::get('dtdd/product-variant/{slug}', 'getVariantBySlug')->name('product.get.variant-card');
});
