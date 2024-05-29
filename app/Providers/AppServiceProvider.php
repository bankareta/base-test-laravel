<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon;
use Schema;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_ALL, env('APP_LOCALE', 'en'));
        Carbon::setLocale(env('APP_LOCALE', 'en'));
        Schema::defaultStringLength(191); //191
        Relation::morphMap([
            'inspection_record' => 'App\Models\Inspection\InspectionVisit',
            'accident' => 'App\Models\Accident\Report',
            'hira' => 'App\Models\Hira\Hira',
            'hnmr' => 'App\Models\Hnmr\Reporting', 
            'equipment' => 'App\Models\Equipment\Equipment', 
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
