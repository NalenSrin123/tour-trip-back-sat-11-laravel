<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        try {
            // កែសម្រួលត្រង់នេះ៖ មិនបាច់ដាក់ exists:... ទេ ដើម្បីងាយស្រួលតេស្ត
            $validated = $request->validate([
                'tour_id' => 'required|integer',
                'user_id' => 'required|integer',
                'rating'  => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string',
                'status'  => 'nullable|string',
            ]);

            $review = Review::create($validated);

            return response()->json([
                'status'  => true,
                'message' => 'Review created successfully!',
                'data'    => $review
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation Error',
                'errors'  => $e->errors()
            ], 422);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to create review!',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string|int $id)
    {
        try {
            $review = Review::find($id);

            if (!$review) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Review not found!'
                ], 404);
            }

            $review->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Review deleted successfully!'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to delete review!',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}