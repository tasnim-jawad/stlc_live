<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Modules\Management\WarehouseManagement\WarehouseProductOut\Observer\WarehouseProductOutObserver;
use App\Modules\Management\WarehouseManagement\WarehouseProductOut\Models\WareHouseProductOutProductModel as WarehouseProductOut;

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
        Paginator::useBootstrap();
        // WarehouseProductOut::observe(WarehouseProductOutObserver::class);

        $settingTitles = DB::table("con_setting_title")
            ->select('*')
            ->get()
            ->map(function ($title) {
            $title->values = DB::table("con_setting_title_values")
                ->where("setting_title_id", $title->id)
                ->get();
            return $title;
            });
        

        view()->share('settingTitles', $settingTitles);

    }
}
