<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * GET /api/admin/categories or /api/user/categories
     * List all categories with filtering, search, and pagination
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        // Filter active categories
        if ($request->has('active')) {
            $query->where('is_active', $request->active);
        }

        // Sorting
        $sortBy = $request->get('sort', 'display_order');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 20);
        $categories = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => $categories->items(),
            'pagination' => [
                'total' => $categories->total(),
                'per_page' => $categories->perPage(),
                'current_page' => $categories->currentPage(),
                'last_page' => $categories->lastPage(),
                'from' => $categories->firstItem(),
                'to' => $categories->lastItem(),
            ]
        ]);
    }

    /**
     * POST /api/admin/categories
     * Create a new category
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        
        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    /**
     * GET /api/admin/categories/{id} or /api/user/categories/{id}
     * Get a single category by ID
     */
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'message' => 'Category retrieved successfully',
            'data' => $category
        ]);
    }

    /**
     * PUT/PATCH /api/admin/categories/{id}
     * Update a category
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        
        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    /**
     * DELETE /api/admin/categories/{id}
     * Delete a category
     */
    public function destroy(Category $category)
    {
        // Check if category has products
        if ($category->products()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete category with products'
            ], 409);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
            'data' => null
        ]);
    }

    /**
     * POST /api/admin/categories/{id}/toggle-active
     * Toggle category active status
     */
    public function toggleActive(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Category status toggled successfully',
            'data' => $category
        ]);
    }
}
