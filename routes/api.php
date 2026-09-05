<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

// Laravel នឹងបង្កើត Routes ទាំង ៥ (GET, POST, PUT, DELETE) ឲ្យដោយស្វ័យប្រវត្តិ
Route::apiResource('categories', CategoryController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
