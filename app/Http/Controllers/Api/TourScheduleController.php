<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourSchedule;
use Illuminate\Http\Request;

class TourScheduleController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'category_id' => 'required|exists:tour_categories,id',
            'destination_id' => 'required|exists:destinations,id',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'included_services' => 'nullable|string',
            'excluded_services' => 'nullable|string',
            'rating_avg' => 'nullable|numeric|min:0|max:5',

        ]);

        $schedule = TourSchedule::create($validated);
        return response()->json([
            'success'=> true,
            'message' => 'Tourschedule created successfully.',
            'data' => $schedule,
        ], 201);
    }

    public function index(){
        $schedules = TourSchedule::with([
            'tour',
            'category',
            'destionation',
        ])
        ->latest('created_at')
        ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Tour schedule retrieved successfully.',
            'date' => $schedules,
        ]);
    }

}
