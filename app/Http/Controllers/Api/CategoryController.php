<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. View All (Read)
    public function index() {
        return response()->json(Category::all(), 200);
    }

    // 2. Create (Insert)
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $category = Category::create($request->all());
        return response()->json(['message' => 'បង្កើតបានជោគជ័យ!', 'data' => $category], 201);
    }

    // 3. View Single Category (Read តែមួយ)
    public function show($id) {
        $category = Category::find($id);
        if(!$category) return response()->json(['message' => 'រកមិនឃើញទេ'], 404);
        return response()->json($category, 200);
    }

    // 4. Update (កែប្រែ)
    public function update(Request $request, $id) {
        $category = Category::find($id);
        if(!$category) return response()->json(['message' => 'រកមិនឃើញទេ'], 404);
        
        $category->update($request->all());
        return response()->json(['message' => 'កែប្រែបានជោគជ័យ!', 'data' => $category], 200);
    }

    // 5. Delete (លុប)
    public function destroy($id) {
        $category = Category::find($id);
        if(!$category) return response()->json(['message' => 'រកមិនឃើញទេ'], 404);
        
        $category->delete();
        return response()->json(['message' => 'លុបបានជោគជ័យ!'], 200);
    }
}