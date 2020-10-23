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
        ];

        foreach ($repositories as $key=>$val){
            $this->app->bind("App\\Repositories\\$key", "App\\Repositories\\$val");
        }
    }

    /**
     * Log database queries and bindings to the standard log
     * Only when in debug mode and not running unit tests
     */
    protected function bootDBLogger()
    {
        if (config('app.debug_log_queries')) {
            DB::listen(function ($query) {
                $sql = $query->sql;
               foreach ($query->bindings as $binding) {
                   if (is_string($binding)) {
                       $binding = "'{$binding}'";
                   } elseif ($binding === null) {
                       $binding = 'NULL';
                   } elseif ($binding instanceof Carbon) {
                       $binding = "'{$binding->toDateTimeString()}'";
                   } elseif ($binding instanceof DateTime) {
                       $binding = "'{$binding->format('Y-m-d H:i:s')}'";
                   }

                   $sql = preg_replace("/\?/", $binding, $sql, 1);
               }

               Log::channel('queries')->debug('SQL', [
                    'sql' => $sql, 
                    'time' => "$query->time ms"
                ]);
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->bootDBLogger();
    }
}
