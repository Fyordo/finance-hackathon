<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'add.json.header'
], function(){
    Route::group([
        'prefix' => '/auth'
    ], function(){
        Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
        Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
        Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
        Route::post('/refresh', [\App\Http\Controllers\AuthController::class, 'refresh'])->name('refresh');
    });

    Route::group([
        'middleware' => 'auth:api'
    ], function (){
        Route::group([
            'prefix' => '/operation'
        ], function(){
            Route::post('/confirm/{id}', [\App\Http\Controllers\OperationController::class, 'confirm']);
            Route::apiResource('/', \App\Http\Controllers\OperationController::class);
        });

        Route::apiResource('/role', RoleController::class);
        Route::apiResource('/currency', \App\Http\Controllers\CurrencyController::class);
        Route::apiResource('/account', \App\Http\Controllers\AccountController::class);
        Route::apiResource('/user', \App\Http\Controllers\UserController::class)->except('store');
    });
});
