<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class CategoryController extends Controller
{
    // 1. GET (View All Categories)
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'status'  => true,
                'data'    => $categories
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch categories!',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // 2. CREATE (Store New Category)
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_name' => 'required|string|max:255',
                'description'   => 'nullable|string',
            ]);

            $category = Category::create($validated);

            return response()->json([
                'status'  => true,
                'message' => 'បង្កើតបានជោគជ័យ!',
                'data'    => $category
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
                'message' => 'Failed to create category!',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}