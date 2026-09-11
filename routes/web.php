<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TourController;
use App\Http\Controllers\TourCategoryController;
use App\Http\Controllers\TourItineraryController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Tour Categories
    Route::get('tour-categories', [TourCategoryController::class, 'index'])->name('tour-categories.index');
    Route::get('tour-categories/{id}/edit', [TourCategoryController::class, 'edit'])->name('tour-categories.edit');
    Route::put('tour-categories/{id}', [TourCategoryController::class, 'update'])->name('tour-categories.update');
    Route::delete('tour-categories/{id}', [TourCategoryController::class, 'destroy'])->name('tour-categories.destroy');

    // Tours
    Route::get('tours', [TourController::class, 'index'])->name('tours.index');
    Route::get('tours/{id}/edit', [TourController::class, 'edit'])->name('tours.edit');
    Route::put('tours/{id}', [TourController::class, 'update'])->name('tours.update');
    Route::delete('tours/{id}', [TourController::class, 'destroy'])->name('tours.destroy');

    // Tour Itineraries
    Route::get('tour-itineraries', [TourItineraryController::class, 'index'])->name('tour-itineraries.index');
    Route::get('tour-itineraries/{id}/edit', [TourItineraryController::class, 'edit'])->name('tour-itineraries.edit');
    Route::put('tour-itineraries/{id}', [TourItineraryController::class, 'update'])->name('tour-itineraries.update');
    Route::delete('tour-itineraries/{id}', [TourItineraryController::class, 'destroy'])->name('tour-itineraries.destroy');
});