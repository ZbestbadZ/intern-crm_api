<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            'SaleUser\SaleUserRepositoryInterface' => 'SaleUser\SaleUserRepository',
            'EmailAuth\EmailAuthRepositoryInterface' => 'EmailAuth\EmailAuthRepository',
            'Orbit\OrbitRepositoryInterface' => 'Orbit\OrbitRepository',
            'Scale\ScaleRepositoryInterface' => 'Scale\ScaleRepository',
            'CharterCapital\CharterCapitalRepositoryInterface' => 'CharterCapital\CharterCapitalRepository',
            'Category\CategoryRepositoryInterface' => 'Category\CategoryRepository',
            'Companies\CompaniesRepositoryInterface' => 'Companies\CompaniesRepository',
        ];

        foreach ($repositories as $key=>$val){
            $this->app->bind("App\\Repositories\\$key", "App\\Repositories\\$val");
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(255);

        \Validator::extend('numeric_array', function($attribute, $values, $parameters) {
            if(! is_array($values)) {
                return false;
            }

            foreach($values as $v) {
                if(! is_numeric($v)) {
                    return false;
                }
            }

            return true;
        });
    }
}
