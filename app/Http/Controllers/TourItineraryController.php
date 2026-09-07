<?php

namespace App\Http\Controllers;

use App\Models\TourItinerary;
use Illuminate\Http\Request;

class TourItineraryController extends Controller
{
    public function index()
    {
        $itineraries = TourItinerary::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Tour itineraries retrieved successfully',
            'data' => $itineraries,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|integer|exists:tours,tour_id',
            'day_number' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $itinerary = TourItinerary::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Tour itinerary created successfully',
            'data' => $itinerary,
        ], 201);
    }
}