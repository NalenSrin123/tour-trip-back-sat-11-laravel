<?php

use App\Http\Controllers\TourController;

Route::put('/tours/{id}', [TourController::class, 'update']);

Route::delete('/tours/{id}', [TourController::class, 'destroy']);
