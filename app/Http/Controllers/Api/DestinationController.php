<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{
    /**
     * បង្ហាញបញ្ជីរាយនាមគោលដៅទាំងអស់ (List Destinations)
     */
    public function index()
    {
        $destinations = Destination::all();

        return response()->json([
            'success' => true,
            'data' => $destinations
        ], 200);
    }

    /**
     * បញ្ចូលទិន្នន័យគោលដៅថ្មី (Create Destination)
     */
    public function store(Request $request)
    {
        // ពិនិត្យទិន្នន័យ (Validation)
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // រក្សាទុកទិន្នន័យចូលក្នុង Database
        $destination = Destination::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'បានបង្កើតគោលដៅដោយជោគជ័យ!',
            'data' => $destination
        ], 201);
    }
}