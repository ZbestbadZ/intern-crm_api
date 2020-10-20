<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::prefix('saleuser')->group(function () {
        Route::post('/create', 'SaleUserController@create');
    });
});