@extends('layouts.admin')

@section('title', 'Thêm danh mục')
@section('page-title', 'Thêm Danh Mục Mới')
@section('page-subtitle', 'Tạo một danh mục sản phẩm mới')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="card">
            <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
                @csrf

                <div class="input-group">
                    <label for="name">Tên Danh Mục <span class="text-red-400">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Nhập tên danh mục" required>
                </div>

                <div class="input-group">
                    <label for="description">Mô Tả</label>
                    <textarea name="description" id="description" rows="4" placeholder="Mô tả danh mục (tuỳ chọn)"></textarea>
                </div>

                <div class="input-group">
                    <label for="display_order">Thứ Tự Hiển Thị</label>
                    <input type="number" name="display_order" id="display_order" placeholder="0" min="0" value="0">
                </div>

                <div class="input-group">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Hoạt động</span>
                    </label>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Tạo Danh Mục
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div>
        <div class="card">
            <h3 class="text-lg font-orbitron font-bold text-cyan-400 mb-4">Hướng Dẫn</h3>
            <div class="space-y-4 text-sm text-gray-300">
                <div>
                    <strong class="text-cyan-400">Tên Danh Mục:</strong>
                    <p>Tên phân loại sản phẩm (vd: Điện tử, Thời trang...)</p>
                </div>
                <div>
                    <strong class="text-cyan-400">Mô Tả:</strong>
                    <p>Mô tả chi tiết danh mục để giúp khách hiểu rõ hơn.</p>
                </div>
                <div>
                    <strong class="text-cyan-400">Thứ Tự Hiển Thị:</strong>
                    <p>Số nhỏ hơn sẽ hiển thị trước (0, 1, 2...).</p>
                </div>
                <div>
                    <strong class="text-cyan-400">Hoạt Động:</strong>
                    <p>Bật để danh mục xuất hiện trên website.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    // Auto generate slug from name
    document.getElementById('name').addEventListener('change', function() {
        const slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
    });
</script>
@endsection
