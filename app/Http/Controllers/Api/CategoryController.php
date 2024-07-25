<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //store category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $category = Category::create([
            'seller_id' => $request->user()->id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    //get all data from category
    public function index(Request $request)
    {
        $categories = Category::where('seller_id', $request->user()->id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Category data',
            'data' => $categories
        ], 200);
    }

    //get category by id
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Category data',
            'data' => $category
        ], 200);
    }

    //update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);
    }

    //delete category
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
