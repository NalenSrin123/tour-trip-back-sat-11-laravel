<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ReviewController;

// 1. API សម្រាប់ Review (Create & Delete)
Route::post('/reviews', [ReviewController::class, 'store']);
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

// 2. API សម្រាប់ Category (CRUD)
Route::apiResource('categories', CategoryController::class);

// 3. User Authentication Route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});