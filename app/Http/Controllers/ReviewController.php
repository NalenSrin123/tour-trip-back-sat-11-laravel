<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // API កែប្រែ Review (Update/Edit)
    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => false,
                'message' => 'រកមិនឃើញ Review នេះទេ!'
            ], 404);
        }

        $validated = $request->validate([
            'rating'  => 'sometimes|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'status'  => 'sometimes|string',
        ]);

        $review->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'កែប្រែ Review បានជោគជ័យ!',
            'data' => $review
        ], 200);
    }

    // API លុប Review (Delete)
    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => false,
                'message' => 'រកមិនឃើញ Review នេះទេ!'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'status' => true,
            'message' => 'លុប Review បានជោគជ័យ!'
        ], 200);
    }
}