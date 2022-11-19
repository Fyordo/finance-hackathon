<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'add.json.header'
], function(){
    Route::apiResource('/role', RoleController::class);
});
