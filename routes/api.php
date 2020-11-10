<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::prefix('sale/user')->group(function () {
        Route::post('/create', 'SaleUserController@create');
        Route::post('/verify', 'SaleUserController@checkExpiration');
        Route::post('/login', 'SaleUserController@login');
        Route::post('/forgot_password', 'SaleUserController@forgotPassword');
        Route::post('/verify_forgot', 'SaleUserController@verifyForgotPassword');
        Route::post('/change_forgot_password', 'SaleUserController@changeForgotPassword');
        Route::post('/logout', 'SaleUserController@logout');
    });

    Route::group(['middleware' => 'authApi'], function () {
        Route::prefix('sale/user')->group(function () {
            Route::post('/profile', 'SaleUserController@profile');
        });

        Route::get('/domains', 'DomainController@index');

        Route::prefix('companies')->group(function () {
            Route::post('', 'CompaniesController@create');
            Route::get('', 'CompaniesController@index');
            Route::get('/{id}', 'CompaniesController@show');
            Route::put('/{id}', 'CompaniesController@update');
            Route::delete('/{id}', 'CompaniesController@delete');
        });
    });
});
