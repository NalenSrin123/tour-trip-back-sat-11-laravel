<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TourItineraryController extends Controller
{
    /**
     * List page with edit/delete actions.
     */
    public function index()
    {
        $itineraries = TourItinerary::with('tour')
            ->orderByDesc('tour_itineraries_id')
            ->get();

        return view('tour_itineraries.index', compact('itineraries'));
    }

    /**
     * Show the edit form for an itinerary.
     */
    public function edit($id)
    {
        $itinerary = TourItinerary::where('tour_itineraries_id', $id)->firstOrFail();
        $tours = Tour::orderBy('title')->get();

        return view('tour_itineraries.edit', compact('itinerary', 'tours'));
    }

    /**
     * Update tour_id, day_number, title and description.
     */
    public function update(Request $request, $id)
    {
        $itinerary = TourItinerary::where('tour_itineraries_id', $id)->first();

        if (!$itinerary) {
            if ($request->routeIs('admin.*')) {
                return redirect()->route('admin.tour-itineraries.index')
                    ->with('error', 'Tour itinerary not found.');
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Tour itinerary not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tour_id' => 'sometimes|required|exists:tours,tour_id',
            'day_number' => 'sometimes|required|integer|min:1',
            'title' => 'sometimes|required|string|max:191',
            'description' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->routeIs('admin.*')) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $itinerary->update($validator->validated());

        if ($request->routeIs('admin.*')) {
            return redirect()->route('admin.tour-itineraries.index')
                ->with('success', 'Tour itinerary updated successfully.');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Tour itinerary updated successfully',
            'data' => $itinerary->fresh(),
        ], 200);
    }

    /**
     * Delete an itinerary.
     */
    public function destroy(Request $request, $id)
    {
        $itinerary = TourItinerary::where('tour_itineraries_id', $id)->first();

        if (!$itinerary) {
            if ($request->routeIs('admin.*')) {
                return redirect()->route('admin.tour-itineraries.index')
                    ->with('error', 'Tour itinerary not found.');
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Tour itinerary not found',
            ], 404);
        }

        DB::transaction(function () use ($itinerary) {
            $itinerary->delete();
        });

        if ($request->routeIs('admin.*')) {
            return redirect()->route('admin.tour-itineraries.index')
                ->with('success', 'Tour itinerary deleted successfully.');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Tour itinerary deleted successfully',
        ], 200);
    }
}