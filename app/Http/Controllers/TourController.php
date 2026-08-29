<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
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
