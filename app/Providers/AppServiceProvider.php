<?php

namespace App\Providers;

use App\Enums\ActionStatus;
use App\Enums\OperationEnum;
use App\Enums\TableEnum;
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
        $actionStatuses = ActionStatus::allCases();
        $operationsEnum = OperationEnum::allCases();
        $tablesEnum = TableEnum::allCases();

        View::share('viewsDir', 'resources/views');
        View::share('cssDir', 'resources/css');
        View::share('jsDir', 'resources/js');
        View::share('actionStatuses', $actionStatuses);
        View::share('operationsEnum', $operationsEnum);
        View::share('tablesEnum', $tablesEnum);
    }
}
