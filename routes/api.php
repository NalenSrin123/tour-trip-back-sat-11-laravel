<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourCategoryController;
use App\Http\Controllers\TourItineraryController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourGalleryController;
use App\Http\Controllers\Api\TourScheduleController;


Route::get('/destinations', [DestinationController::class, 'index']);


Route::post('/destinations', [DestinationController::class, 'store']);


Route::put('/destinations/{id}', [\App\Http\Controllers\DestinationController::class, 'update']);
Route::delete('/destinations/{id}', [\App\Http\Controllers\DestinationController::class, 'destroy']);

Route::get('/list-tours', [TourController::class, 'index']);
Route::post('/create-tours', [TourController::class, 'store']);

Route::get('/tour-itineraries', [TourItineraryController::class, 'index']);
Route::post('/tour-itineraries', [TourItineraryController::class, 'store']);

Route::put('/tours/{id}', [TourController::class, 'update']);
Route::delete('/tours/{id}', [TourController::class, 'destroy']);

// Tour categories (edit/delete only)
Route::put('/tour-categories/{id}', [TourCategoryController::class, 'update']);
Route::delete('/tour-categories/{id}', [TourCategoryController::class, 'destroy']);

// Tour itineraries (edit/delete only)
Route::put('/tour-itineraries/{id}', [TourItineraryController::class, 'update']);
Route::delete('/tour-itineraries/{id}', [TourItineraryController::class, 'destroy']);

Route::apiResource('roles', RoleController::class);
Route::apiResource('categories', CategoryController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});


Route::apiResource('tour-galleries', TourGalleryController::class);

Route::get('/tour-schedules',[TourScheduleController::class, 'index']);
Route::post('/tour-schedules',[TourScheduleController::class, 'store']);

use App\Http\Controllers\Api\ReviewController;

Route::put('/reviews/{id}', [ReviewController::class, 'update']);
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

