<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    const SUCCESS_NUMBER = 1;
    const FAILURE_NUMER = 0;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $class = $this;

        Response::macro('success', function ($data) use ($class) {
            return response()->json([
                'success' => $class::SUCCESS_NUMBER,
                'data' => $data
            ]);
        });

        Response::macro('error', function ($errors, $statusCode = 400) use ($class) {
            return response()->json([
                'success' => $class::FAILURE_NUMER,
                'errors' => $errors
            ], $statusCode);
        });
    }
}
