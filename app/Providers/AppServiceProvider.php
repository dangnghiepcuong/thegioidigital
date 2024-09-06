<?php

namespace App\Providers;

use App\Enums\ActionStatusEnum;
use App\Enums\ModelMetaKey;
use App\Enums\OperationEnum;
use App\Enums\ProductStatusEnum;
use App\Enums\ProductTypeEnum;
use App\Enums\TableEnum;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        $actionStatuses = ActionStatusEnum::allCases();
        $operationsEnum = OperationEnum::allCases();
        $tablesEnum = TableEnum::allCases();
        $productTypesEnum = ProductTypeEnum::allCases();
        $productStatusesEnum = ProductStatusEnum::allCases();

        View::share('viewsDir', 'resources/views');
        View::share('cssDir', 'resources/css');
        View::share('jsDir', 'resources/js');
        View::share('actionStatuses', $actionStatuses);
        View::share('operationsEnum', $operationsEnum);
        View::share('tablesEnum', $tablesEnum);
        View::share('modelMetaKey', ModelMetaKey::allCases());
        View::share('productTypesEnum', $productTypesEnum);
        View::share('productStatusesEnum', $productStatusesEnum);

        Relation::enforceMorphMap([
            'product' => 'App\Models\Product',
        ]);
    }
}
