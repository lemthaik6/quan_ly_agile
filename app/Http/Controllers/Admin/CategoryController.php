<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Danh sách danh mục
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        // Sắp xếp
        $sortBy = $request->get('sort', 'display_order');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $categories = $query->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Form tạo danh mục mới
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Lưu danh mục mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        // Tạo slug từ tên
        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Danh mục đã được tạo thành công!');
    }

    /**
     * Form chỉnh sửa danh mục
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Cập nhật danh mục
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        // Cập nhật slug nếu tên thay đổi
        if ($category->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Danh mục đã được cập nhật!');
    }

    /**
     * Xóa danh mục
     */
    public function destroy(Category $category)
    {
        // Kiểm tra nếu danh mục có sản phẩm
        if ($category->products()->exists()) {
            return redirect()->back()->with('error', 'Không thể xóa danh mục này vì nó đang chứa sản phẩm!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Danh mục đã được xóa!');
    }

    /**
     * Thay đổi trạng thái hoạt động
     */
    public function toggleActive(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        return redirect()->back()->with('success', 'Trạng thái danh mục đã được cập nhật!');
    }
}
