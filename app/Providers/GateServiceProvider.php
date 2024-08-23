<?php

namespace App\Providers;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class GateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('is-admin', function (User $user) {
            return RoleEnum::ADMIN === $user->role_id;
        });

        Gate::define('is-user', function (User $user) {
            return RoleEnum::USER === $user->role_id;
        });
    }
}
