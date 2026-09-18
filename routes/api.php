<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ReviewController;

Route::post('/reviews', [ReviewController::class, 'store']);
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

Route::apiResource('categories', CategoryController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});