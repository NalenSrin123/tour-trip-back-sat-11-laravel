<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'status'  => 'nullable|string'
        ]);

        $review = Review::create($validated);

        return response()->json([
            'message' => 'Review created successfully!',
            'data'    => $review
        ], 201);
    }
    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found!'], 404);
        }

        $review->delete();


        return response()->json(['message' => 
        'Review deleted successfully!'], 200);
    }
}
