<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Danh sách sản phẩm
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('sku', 'like', "%$search%");
        }

        // Lọc theo danh mục
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Sắp xếp
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $products = $query->paginate(15);
        $categories = Category::where('is_active', 1)->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Form tạo sản phẩm mới
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        $colors = Color::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();

        return view('admin.products.create', compact('categories', 'colors', 'sizes'));
    }

    /**
     * Lưu sản phẩm mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'quantity_in_stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:products',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'product_colors' => 'nullable|array',
            'product_colors.ids' => 'nullable|array',
            'product_colors.ids.*' => 'nullable|exists:colors,id',
            'product_colors.stock' => 'nullable|array',
            'product_colors.stock.*' => 'nullable|integer|min:0',
            'product_sizes' => 'nullable|array',
            'product_sizes.ids' => 'nullable|array',
            'product_sizes.ids.*' => 'nullable|exists:sizes,id',
            'product_sizes.stock' => 'nullable|array',
            'product_sizes.stock.*' => 'nullable|integer|min:0',
        ]);

        // Tạo slug từ tên
        $validated['slug'] = Str::slug($validated['name']);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');
            $validated['image'] = 'products/' . $imageName;
        }

        $product = Product::create($validated);
        $this->syncProductVariants(
            $product,
            $request->input('product_colors.ids', []),
            $request->input('product_colors.stock', []),
            $request->input('product_sizes.ids', []),
            $request->input('product_sizes.stock', [])
        );

        return redirect()->route('admin.products.index')
                        ->with('success', 'Sản phẩm đã được tạo thành công!');
    }

    /**
     * Form chỉnh sửa sản phẩm
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', 1)->get();
        $colors = Color::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();

        return view('admin.products.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'quantity_in_stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'product_colors' => 'nullable|array',
            'product_colors.ids' => 'nullable|array',
            'product_colors.ids.*' => 'nullable|exists:colors,id',
            'product_colors.stock' => 'nullable|array',
            'product_colors.stock.*' => 'nullable|integer|min:0',
            'product_sizes' => 'nullable|array',
            'product_sizes.ids' => 'nullable|array',
            'product_sizes.ids.*' => 'nullable|exists:sizes,id',
            'product_sizes.stock' => 'nullable|array',
            'product_sizes.stock.*' => 'nullable|integer|min:0',
        ]);

        // Cập nhật slug nếu tên thay đổi
        if ($product->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Xử lý upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');
            $validated['image'] = 'products/' . $imageName;
        }

        $product->update($validated);
        $this->syncProductVariants(
            $product,
            $request->input('product_colors.ids', []),
            $request->input('product_colors.stock', []),
            $request->input('product_sizes.ids', []),
            $request->input('product_sizes.stock', [])
        );

        return redirect()->route('admin.products.index')
                        ->with('success', 'Sản phẩm đã được cập nhật!');
    }

    /**
     * Đồng bộ biến thể sản phẩm
     */
    private function syncProductVariants(Product $product, array $colorIds, array $colorStocks, array $sizeIds, array $sizeStocks)
    {
        $product->colors()->delete();
        $product->sizes()->delete();

        foreach ($colorIds as $colorId) {
            $color = Color::find($colorId);
            if (!$color) {
                continue;
            }

            $product->colors()->create([
                'color_id' => $color->id,
                'color_name' => $color->name,
                'color_hex' => $color->hex_code,
                'stock_quantity' => $colorStocks[$colorId] ?? 0,
            ]);
        }

        foreach ($sizeIds as $sizeId) {
            $size = Size::find($sizeId);
            if (!$size) {
                continue;
            }

            $product->sizes()->create([
                'size_id' => $size->id,
                'size_name' => $size->name,
                'stock_quantity' => $sizeStocks[$sizeId] ?? 0,
            ]);
        }
    }

    /**
     * Xóa sản phẩm
     */
    public function destroy(Product $product)
    {
        // Xóa ảnh nếu có
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                        ->with('success', 'Sản phẩm đã được xóa!');
    }

    /**
     * Thay đổi trạng thái hoạt động
     */
    public function toggleActive(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        return redirect()->back()->with('success', 'Trạng thái sản phẩm đã được cập nhật!');
    }

    /**
     * Thay đổi trạng thái nổi bật
     */
    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);

        return redirect()->back()->with('success', 'Trạng thái nổi bật đã được cập nhật!');
    }
}
