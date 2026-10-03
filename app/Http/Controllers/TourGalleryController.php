<?php

namespace App\Http\Controllers;

use App\Models\TourGallery;
use Illuminate\Http\Request;

class TourGalleryController extends Controller
{
    public function index()
    {
        $galleries = TourGallery::with('tour')->get();
        return response()->json(['status' => 'success', 'data' => $galleries], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,tour_id',
            'image_url' => 'required|string|max:255',
        ]);

        $gallery = TourGallery::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Created successfully', 'data' => $gallery], 201);
    }

    public function show($id)
    {
        $gallery = TourGallery::with('tour')->find($id);
        if (!$gallery) {
            return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $gallery], 200);
    }

    public function update(Request $request, $id)
    {
        $gallery = TourGallery::find($id);
        if (!$gallery) {
            return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
        }

        $validated = $request->validate([
            'tour_id' => 'sometimes|required|exists:tours,tour_id',
            'image_url' => 'sometimes|required|string|max:255',
        ]);

        $gallery->update($validated);
        return response()->json(['status' => 'success', 'message' => 'Updated successfully', 'data' => $gallery], 200);
    }

    public function destroy($id)
    {
        $gallery = TourGallery::find($id);
        if (!$gallery) {
            return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
        }

        $gallery->delete();
        return response()->json(['status' => 'success', 'message' => 'Deleted successfully'], 200);
    }
}
