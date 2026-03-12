@extends('layouts.admin')

@section('title', 'Chỉnh sửa danh mục')
@section('page-title', 'Chỉnh Sửa Danh Mục')
@section('page-subtitle', 'Cập nhật thông tin danh mục')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="card">
            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="input-group">
                    <label for="name">Tên Danh Mục <span class="text-red-400">*</span></label>
                    <input type="text" name="name" id="name" value="{{ $category->name }}" placeholder="Nhập tên danh mục" required>
                </div>

                <div class="input-group">
                    <label for="description">Mô Tả</label>
                    <textarea name="description" id="description" rows="4" placeholder="Mô tả danh mục (tuỳ chọn)">{{ $category->description }}</textarea>
                </div>

                <div class="input-group">
                    <label for="display_order">Thứ Tự Hiển Thị</label>
                    <input type="number" name="display_order" id="display_order" value="{{ $category->display_order ?? 0 }}" min="0">
                </div>

                <div class="input-group">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
                        <span>Hoạt động</span>
                    </label>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Cập Nhật
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i> Quay Lại
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="space-y-4">
        <div class="card">
            <h3 class="text-lg font-orbitron font-bold text-cyan-400 mb-4">Thông Tin</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-400">ID:</span>
                    <p class="text-cyan-400 font-semibold">#{{ $category->id }}</p>
                </div>
                <div>
                    <span class="text-gray-400">Slug:</span>
                    <p class="text-cyan-300 text-xs break-all">{{ $category->slug }}</p>
                </div>
                <div>
                    <span class="text-gray-400">Ngày tạo:</span>
                    <p class="text-cyan-300">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <span class="text-gray-400">Sản phẩm:</span>
                    <p class="text-green-400 font-semibold">{{ $category->products()->count() }} sản phẩm</p>
                </div>
            </div>
        </div>

        @if($category->products()->count() > 0)
            <div class="card">
                <h3 class="text-lg font-orbitron font-bold text-cyan-400 mb-4">Sản Phẩm ({{ $category->products()->count() }})</h3>
                <div class="space-y-2 max-h-64 overflow-y-auto">
                    @foreach($category->products()->limit(10)->get() as $product)
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="block p-2 rounded hover:bg-cyan-400/10 text-sm text-gray-300 hover:text-cyan-400">
                            • {{ $product->name }}
                        </a>
                    @endforeach
                    @if($category->products()->count() > 10)
                        <div class="text-xs text-gray-500 p-2">... và {{ $category->products()->count() - 10 }} sản phẩm khác</div>
                    @endif
                </div>
            </div>
        @endif

        <div class="card">
            <h3 class="text-lg font-orbitron font-bold text-red-400 mb-4">Nguy Hiểm</h3>
            @if($category->products()->count() == 0)
                <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Bạn chắc chắn muốn xóa danh mục này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger w-full">
                        <i class="fas fa-trash mr-2"></i> Xóa Danh Mục
                    </button>
                </form>
            @else
                <p class="text-sm text-gray-400 p-4 bg-red-400/10 rounded border border-red-400/20">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Không thể xóa danh mục này vì nó đang chứa {{ $category->products()->count() }} sản phẩm
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
