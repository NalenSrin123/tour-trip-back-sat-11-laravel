<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\Api\CategoryController;
<<<<<<< HEAD
use App\Http\Controllers\Api\ReviewController;

Route::post('/reviews', [ReviewController::class, 'store']);       // សម្រាប់ Create
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']); // សម្រាប់ Delete
=======
// Route សម្រាប់ទាញយកទិន្នន័យទាំងអស់មកបង្ហាញ (List)
Route::get('/destinations', [DestinationController::class, 'index']);
>>>>>>> 0d816294fca7ef174417130aed17ff92c2d03b78

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
