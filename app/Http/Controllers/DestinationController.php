<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{
    // API សម្រាប់ធ្វើការ Update
    public function update(Request $request, $id)
    {
        // ស្វែងរក record តាម primaryKey (destination_id)
        $destination = Destination::find($id);

        if (!$destination) {
            return response()->json(['message' => 'រកមិនឃើញទិន្នន័យឡើយ!'], 404);
        }

        // Validate ទិន្នន័យ
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'ទិន្នន័យមិនត្រឹមត្រូវ!',
                'errors' => $validator->errors()
            ], 422);
        }

        // ធ្វើការ Update
        $destination->update($validator->validated());

        return response()->json([
            'message' => 'update successfull!',
            'data' => $destination
        ], 200);
    }

    // API សម្រាប់ធ្វើការ Delete
    public function destroy($id)
    {
        $destination = Destination::find($id);

        if (!$destination) {
            return response()->json(['message' => 'Not Found!'], 404);
        }

        $destination->delete();

        return response()->json(['message' => 'Delete Successfull!'], 200);
    }
}