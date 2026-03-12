@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')
@section('page-title', 'Thêm Sản Phẩm Mới')
@section('page-subtitle', 'Tạo một sản phẩm mới cho hệ thống')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-2">
        <div class="card">
            <form method="POST" action="{{ route('admin.products.store') }}" class="space-y-6">
                @csrf

                <div class="input-group">
                    <label for="category_id">Danh Mục <span class="text-red-400">*</span></label>
                    <select name="category_id" id="category_id" class="w-full" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <label for="name">Tên Sản Phẩm <span class="text-red-400">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Nhập tên sản phẩm" required>
                </div>

                <div class="input-group">
                    <label for="sku">Mã SKU</label>
                    <input type="text" name="sku" id="sku" placeholder="Mã SKU (tuỳ chọn)">
                </div>

                <div class="input-group">
                    <label for="short_description">Mô Tả Ngắn</label>
                    <textarea name="short_description" id="short_description" rows="2" placeholder="Mô tả ngắn gọn"></textarea>
                </div>

                <div class="input-group">
                    <label for="description">Mô Tả Chi Tiết</label>
                    <textarea name="description" id="description" rows="5" placeholder="Mô tả chi tiết sản phẩm"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="input-group">
                        <label for="price">Giá Bán (VNĐ) <span class="text-red-400">*</span></label>
                        <input type="number" name="price" id="price" placeholder="0" min="0" step="100" required>
                    </div>

                    <div class="input-group">
                        <label for="cost_price">Giá Vốn (VNĐ)</label>
                        <input type="number" name="cost_price" id="cost_price" placeholder="0" min="0" step="100">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="input-group">
                        <label for="discount_price">Giá Sau Giảm (VNĐ)</label>
                        <input type="number" name="discount_price" id="discount_price" placeholder="0" min="0" step="100">
                    </div>

                    <div class="input-group">
                        <label for="quantity_in_stock">Số Lượng Tồn Kho <span class="text-red-400">*</span></label>
                        <input type="number" name="quantity_in_stock" id="quantity_in_stock" placeholder="0" min="0" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="input-group">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1">
                            <span>Sản phẩm nổi bật</span>
                        </label>
                    </div>

                    <div class="input-group">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked>
                            <span>Hoạt động</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Tạo Sản Phẩm
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Helper -->
    <div>
        <div class="card">
            <h3 class="text-lg font-orbitron font-bold text-cyan-400 mb-4">Hướng Dẫn</h3>
            <div class="space-y-4 text-sm text-gray-300">
                <div>
                    <strong class="text-cyan-400">Danh Mục:</strong>
                    <p>Chọn danh mục chính cho sản phẩm này.</p>
                </div>
                <div>
                    <strong class="text-cyan-400">SKU:</strong>
                    <p>Mã định danh duy nhất cho sản phẩm (tuỳ chọn).</p>
                </div>
                <div>
                    <strong class="text-cyan-400">Giá Bán:</strong>
                    <p>Giá khách hàng sẽ thấy khi mua.</p>
                </div>
                <div>
                    <strong class="text-cyan-400">Giá Vốn:</strong>
                    <p>Giá nhập hàng để tính lợi nhuận.</p>
                </div>
                <div>
                    <strong class="text-cyan-400">Giá Giảm:</strong>
                    <p>Nếu có khuyến mãi, nhập giá sau khi giảm.</p>
                </div>
                <hr class="border-cyan-400/20 my-4">
                <div>
                    <strong class="text-cyan-400">Sản Phẩm Nổi Bật:</strong>
                    <p>Hiển thị sản phẩm này ở trang chủ.</p>
                </div>
                <div>
                    <strong class="text-cyan-400">Hoạt Động:</strong>
                    <p>Bật để hiển thị sản phẩm cho khách hàng.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    // Auto generate SKU from name if empty
    document.getElementById('name').addEventListener('change', function() {
        const skuInput = document.getElementById('sku');
        if (!skuInput.value) {
            skuInput.value = this.value.substring(0, 3).toUpperCase() + new Date().getTime().toString().slice(-5);
        }
    });
</script>
@endsection
