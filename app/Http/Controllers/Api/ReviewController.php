<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // មុខងារកែប្រែ (Update/Edit)
    public function update(Request $request, $id)
    {
        // កែពី review_id មកជា reviews_id ឱ្យត្រូវនឹង phpMyAdmin
        $review = Review::where('reviews_id', $id)->first();

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found.'
            ], 404);
        }

        $validated = $request->validate([
            'rating' => 'sometimes|numeric|min:0|max:5',
            'comment' => 'sometimes|string',
        ]);

        $review->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Review updated successfully.',
            'data' => $review
        ], 200);
    }

    // មុខងារលុប (Delete)
    public function destroy($id)
    {
        // កែពី review_id មកជា reviews_id ឱ្យត្រូវនឹង phpMyAdmin
        $review = Review::where('reviews_id', $id)->first();

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found.'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully.'
        ], 200);
    }
}