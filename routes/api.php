<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::prefix('sale/user')->group(function () {
        Route::post('/create', 'SaleUserController@create');
        Route::post('/verify', 'SaleUserController@checkExpiration');
        Route::post('/login', 'SaleUserController@login');
        Route::post('/forgotPassword', 'SaleUserController@forgotPassword');
        Route::post('/verifyForgot', 'SaleUserController@verifyForgotPassword');
        Route::post('/changeForgotPassword', 'SaleUserController@changeForgotPassword');
    });

    Route::group(['middleware' => 'authApi'], function () {
        Route::get('/listuser', function(){
            echo 'sale list';
        });
    });
});