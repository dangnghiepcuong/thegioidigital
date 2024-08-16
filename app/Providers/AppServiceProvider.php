<?php

namespace App\Providers;

use App\Enums\ActionStatus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $actionStatuses = new ActionStatus();

        View::share('viewsDir', 'resources/views');
        View::share('cssDir', 'resources/css');
        View::share('jsDir', 'resources/js');
        View::share('actionStatuses', $actionStatuses);
    }
}
