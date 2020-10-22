<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::post('/auth/login', 'SaleUserController@login');
    
    Route::prefix('saleuser')->group(function () {
        Route::post('/create', 'SaleUserController@create');
        Route::post('/verify', 'SaleUserController@checkExpiration');
    });

    Route::group(['middleware' => 'authApi'], function () {
        Route::get('/listuser', function(){
            echo 'sale list';
        });

        Route::post('/auth/logout', 'SaleUserController@logout');
    });
});