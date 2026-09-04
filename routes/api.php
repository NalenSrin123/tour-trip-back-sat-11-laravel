<?php

use Illuminate\Support\Facades\Route;

Route::put('/destinations/{id}', [\App\Http\Controllers\DestinationController::class, 'update']);
Route::delete('/destinations/{id}', [\App\Http\Controllers\DestinationController::class, 'destroy']);