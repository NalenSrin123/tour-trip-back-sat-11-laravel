<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    //list
    public function index()
    {
        $tours = Tour::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Tours retrieved successfully',
            'data' => $tours,
        ], 200);
    }
    //create

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:tour_categories,category_id',
            'destination_id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'nullable|string|max:255',
            'included_services' => 'nullable|string',
            'excluded_services' => 'nullable|string',
            'rating_avg' => 'nullable|numeric',
        ]);

        $tour = Tour::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Tour created successfully',
            'data' => $tour,
        ], 201);
    }

    // 1. Edit / Update Tour Function
    public function update(Request $request, $tour_id)
    {
        // Find Tour by tour_id
        $tour = Tour::where('tour_id', $tour_id)->first();

        if (!$tour) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tour not found'
            ], 404);
        }

        // Validate incoming data
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
        ]);

        // Update tour data
        $tour->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Tour updated successfully',
            'data' => $tour
        ], 200);
    }

    // 2. Delete Tour Function
    public function destroy($tour_id)
    {
        // Find Tour by tour_id
        $tour = Tour::where('tour_id', $tour_id)->first();

        if (!$tour) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tour not found'
            ], 404);
        }

        // Delete the tour
        $tour->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tour deleted successfully'
        ], 200);
    }
}
