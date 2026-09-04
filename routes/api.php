<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RoleController;

Route::prefix('v1')->group(function () {

    Route::apiResource('roles', RoleController::class);

});