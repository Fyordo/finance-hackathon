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
        Route::apiResource('/role', RoleController::class);
    });
});
