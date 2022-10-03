<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('products')
     ->controller(\App\Http\Controllers\ProductController::class)
     ->group(function () {
        Route::get('/','index')->name('index');
//        Route::get('/{category:name}','index')->name('index');
     })
;
