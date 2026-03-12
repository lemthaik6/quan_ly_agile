@extends('layouts.admin')

@section('title', 'Chỉnh sửa sản phẩm')
@section('page-title', 'Chỉnh Sửa Sản Phẩm')
@section('page-subtitle', 'Cập nhật thông tin sản phẩm')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-2">
        <div class="card">
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="input-group">
                    <label for="category_id">Danh Mục <span class="text-red-400">*</span></label>
                    <select name="category_id" id="category_id" class="w-full" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <label for="name">Tên Sản Phẩm <span class="text-red-400">*</span></label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}" placeholder="Nhập tên sản phẩm" required>
                </div>

                <div class="input-group">
                    <label for="sku">Mã SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ $product->sku }}" placeholder="Mã SKU (tuỳ chọn)">
                </div>

                <div class="input-group">
                    <label for="short_description">Mô Tả Ngắn</label>
                    <textarea name="short_description" id="short_description" rows="2" placeholder="Mô tả ngắn gọn">{{ $product->short_description }}</textarea>
                </div>

                <div class="input-group">
                    <label for="description">Mô Tả Chi Tiết</label>
                    <textarea name="description" id="description" rows="5" placeholder="Mô tả chi tiết sản phẩm">{{ $product->description }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="input-group">
                        <label for="price">Giá Bán (VNĐ) <span class="text-red-400">*</span></label>
                        <input type="number" name="price" id="price" value="{{ $product->price }}" placeholder="0" min="0" step="100" required>
                    </div>

                    <div class="input-group">
                        <label for="cost_price">Giá Vốn (VNĐ)</label>
                        <input type="number" name="cost_price" id="cost_price" value="{{ $product->cost_price }}" placeholder="0" min="0" step="100">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="input-group">
                        <label for="discount_price">Giá Sau Giảm (VNĐ)</label>
                        <input type="number" name="discount_price" id="discount_price" value="{{ $product->discount_price }}" placeholder="0" min="0" step="100">
                    </div>

                    <div class="input-group">
                        <label for="quantity_in_stock">Số Lượng Tồn Kho <span class="text-red-400">*</span></label>
                        <input type="number" name="quantity_in_stock" id="quantity_in_stock" value="{{ $product->quantity_in_stock }}" placeholder="0" min="0" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="input-group">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }}>
                            <span>Sản phẩm nổi bật</span>
                        </label>
                    </div>

                    <div class="input-group">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                            <span>Hoạt động</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Cập Nhật
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i> Quay Lại
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Info -->
    <div class="space-y-4">
        <div class="card">
            <h3 class="text-lg font-orbitron font-bold text-cyan-400 mb-4">Thông Tin</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-400">ID:</span>
                    <p class="text-fuchsia-400 font-semibold">#{{ $product->id }}</p>
                </div>
                <div>
                    <span class="text-gray-400">Ngày tạo:</span>
                    <p class="text-cyan-300">{{ $product->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <span class="text-gray-400">Lần cập nhật:</span>
                    <p class="text-cyan-300">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <span class="text-gray-400">Đã bán:</span>
                    <p class="text-green-400 font-semibold">{{ $product->sold_count }} sản phẩm</p>
                </div>
            </div>
        </div>

        <div class="card">
            <h3 class="text-lg font-orbitron font-bold text-cyan-400 mb-4">Thống Kê</h3>
            <div class="space-y-3">
                <div class="stat-card">
                    <div class="text-sm text-gray-400">Đánh giá</div>
                    <div class="text-2xl font-bold text-cyan-400">{{ $product->rating }} ⭐</div>
                    <div class="text-xs text-gray-500">{{ $product->review_count }} đánh giá</div>
                </div>
                <div class="stat-card">
                    <div class="text-sm text-gray-400">Lợi nhuận/SP</div>
                    @if($product->cost_price)
                        <div class="text-2xl font-bold text-green-400">{{ number_format($product->price - $product->cost_price, 0, ',', '.') }}đ</div>
                    @else
                        <div class="text-2xl font-bold text-gray-500">N/A</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <h3 class="text-lg font-orbitron font-bold text-red-400 mb-4">Nguy Hiểm</h3>
            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger w-full">
                    <i class="fas fa-trash mr-2"></i> Xóa Sản Phẩm
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
