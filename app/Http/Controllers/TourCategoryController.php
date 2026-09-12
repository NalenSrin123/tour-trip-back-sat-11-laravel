<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TourCategoryController extends Controller
{
    /**
     * List page with edit/delete actions.
     */
    public function index()
    {
        $categories = TourCategory::withCount('tours')
            ->orderByDesc('category_id')
            ->get();

        return view('tour_categories.index', compact('categories'));
    }

    /**
     * Show the edit form for a category.
     */
    public function edit($id)
    {
        $category = TourCategory::where('category_id', $id)->firstOrFail();

        return view('tour_categories.edit', compact('category'));
    }

    /**
     * Update category_name and description.
     */
    public function update(Request $request, $id)
    {
        $category = TourCategory::where('category_id', $id)->first();

        if (!$category) {
            if ($request->routeIs('admin.*')) {
                return redirect()->route('admin.tour-categories.index')
                    ->with('error', 'Tour category not found.');
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Tour category not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'category_name' => 'sometimes|required|string|max:255',
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

        $category->update($validator->validated());

        if ($request->routeIs('admin.*')) {
            return redirect()->route('admin.tour-categories.index')
                ->with('success', 'Tour category updated successfully.');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Tour category updated successfully',
            'data' => $category->fresh(),
        ], 200);
    }

    /**
     * Delete a category safely. Blocks deletion when tours still reference it.
     */
    public function destroy(Request $request, $id)
    {
        $category = TourCategory::where('category_id', $id)->first();

        if (!$category) {
            if ($request->routeIs('admin.*')) {
                return redirect()->route('admin.tour-categories.index')
                    ->with('error', 'Tour category not found.');
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Tour category not found',
            ], 404);
        }

        $toursCount = $category->tours()->count();

        if ($toursCount > 0) {
            $message = "Cannot delete this category because {$toursCount} tour(s) still use it.";

            if ($request->routeIs('admin.*')) {
                return redirect()->route('admin.tour-categories.index')
                    ->with('error', $message);
            }

            return response()->json([
                'status' => 'error',
                'message' => $message,
                'data' => ['tours_in_use' => $toursCount],
            ], 409);
        }

        DB::transaction(function () use ($category) {
            $category->delete();
        });

        if ($request->routeIs('admin.*')) {
            return redirect()->route('admin.tour-categories.index')
                ->with('success', 'Tour category deleted successfully.');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Tour category deleted successfully',
        ], 200);
    }
}