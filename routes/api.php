<?php

use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

Route::get('/list-tours', [TourController::class, 'index']);
Route::post('/create-tours', [TourController::class, 'store']);
Route::put('/tours/{id}', [TourController::class, 'update']);
Route::delete('/tours/{id}', [TourController::class, 'destroy']);
