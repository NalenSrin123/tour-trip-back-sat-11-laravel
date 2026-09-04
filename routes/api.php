<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationController;

// Route សម្រាប់ទាញយកទិន្នន័យទាំងអស់មកបង្ហាញ (List)
Route::get('/destinations', [DestinationController::class, 'index']);

// Route សម្រាប់បញ្ជូនទិន្នន័យថ្មីចូល (Create)
Route::post('/destinations', [DestinationController::class, 'store']);