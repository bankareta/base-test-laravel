<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon;
use Schema;
use Illuminate\Database\Eloquent\Relations\Relation;
use Mews\Captcha\Captcha;
use Illuminate\Support\Facades\Validator;

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

        Validator::extend('captcha_check', function ($attribute, $value, $parameters, $validator) {
            return Captcha::check($value);
        });
    
        Validator::replacer('captcha_check', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, ':attribute tidak cocok.');
        });
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
