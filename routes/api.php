<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\AuthController;
// Route សម្រាប់ទាញយកទិន្នន័យទាំងអស់មកបង្ហាញ (List)
Route::get('/destinations', [DestinationController::class, 'index']);

// Route សម្រាប់បញ្ជូនទិន្នន័យថ្មីចូល (Create)
Route::post('/destinations', [DestinationController::class, 'store']);


Route::put('/destinations/{id}', [\App\Http\Controllers\DestinationController::class, 'update']);
Route::delete('/destinations/{id}', [\App\Http\Controllers\DestinationController::class, 'destroy']);

Route::get('/list-tours', [TourController::class, 'index']);
Route::post('/create-tours', [TourController::class, 'store']);
Route::put('/tours/{id}', [TourController::class, 'update']);
Route::delete('/tours/{id}', [TourController::class, 'destroy']);
Route::apiResource('roles', RoleController::class);
Route::apiResource('categories', CategoryController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

// Protected endpoints
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});
