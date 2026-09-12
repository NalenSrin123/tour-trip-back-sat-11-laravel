<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\TourItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

class TourController extends Controller
{
    /**
     * List tours (JSON for the API, listing page for the web admin).
     */
    public function index(Request $request)
    {
        $tours = Tour::with('category')
            ->withCount('itineraries')
            ->orderByDesc('tour_id')
            ->get();

        if ($request->routeIs('admin.*')) {
            return view('tours.index', compact('tours'));
        }

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

    /**
     * Show the edit form for a tour.
     */
    public function edit($id)
    {
        $tour = Tour::where('tour_id', $id)->firstOrFail();

        $categories = TourCategory::orderBy('category_name')->get();

        $destinations = Schema::hasTable('destinations')
            ? DB::table('destinations')->orderBy('destination_id')->get(['destination_id', 'name'])
            : collect();

        return view('tours.edit', compact('tour', 'categories', 'destinations'));
    }

    /**
     * Update a tour.
     */
    public function update(Request $request, $tour_id)
    {
        $tour = Tour::where('tour_id', $tour_id)->first();

        if (!$tour) {
            if ($request->routeIs('admin.*')) {
                return redirect()->route('admin.tours.index')
                    ->with('error', 'Tour not found.');
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Tour not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|required|exists:tour_categories,category_id',
            'destination_id' => 'sometimes|nullable|integer',
            'title' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0|max:99999999.99',
            'duration' => 'sometimes|nullable|string|max:255',
            'included_services' => 'sometimes|nullable|string',
            'excluded_services' => 'sometimes|nullable|string',
            'rating_avg' => 'sometimes|nullable|numeric|between:0,5',
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

        $tour->update($validator->validated());

        if ($request->routeIs('admin.*')) {
            return redirect()->route('admin.tours.index')
                ->with('success', 'Tour updated successfully.');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Tour updated successfully',
            'data' => $tour->fresh(),
        ], 200);
    }

    /**
     * Delete a tour and its related itineraries safely.
     */
    public function destroy(Request $request, $tour_id)
    {
        $tour = Tour::where('tour_id', $tour_id)->first();

        if (!$tour) {
            if ($request->routeIs('admin.*')) {
                return redirect()->route('admin.tours.index')
                    ->with('error', 'Tour not found.');
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Tour not found',
            ], 404);
        }

        DB::transaction(function () use ($tour) {
            TourItinerary::where('tour_id', $tour->tour_id)->delete();
            $tour->delete();
        });

        if ($request->routeIs('admin.*')) {
            return redirect()->route('admin.tours.index')
                ->with('success', 'Tour deleted successfully.');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Tour deleted successfully',
        ], 200);
    }
}