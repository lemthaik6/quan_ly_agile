@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')
@section('page-title', 'Quản Lý Sản Phẩm')
@section('page-subtitle', 'Danh sách tất cả sản phẩm trong hệ thống')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-orbitron font-bold text-gray-900">Danh Sách Sản Phẩm</h2>
    <a href="{{ route('admin.products.create') }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Thêm Sản Phẩm
    </a>
</div>

<!-- Filters -->
<div class="card mb-6">
    <form method="GET" action="{{ route('admin.products.index') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <input type="text" name="search" placeholder="Tìm kiếm theo tên hoặc SKU..." 
                       value="{{ request('search') }}"
                       class="w-full bg-blue-50 border border-blue-200 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-500 focus:outline-none focus:border-blue-600">
            </div>
            <div>
                <select name="category" class="w-full bg-blue-50 border border-blue-200 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:border-blue-600">
                    <option value="">Tất cả danh mục</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 btn-primary">
                    <i class="fas fa-search mr-2"></i> Tìm Kiếm
                </button>
                <a href="{{ route('admin.products.index') }}" class="flex-1 btn-secondary">
                    <i class="fas fa-redo mr-2"></i> Đặt Lại
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Table -->
<div class="card overflow-hidden">
    @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Danh Mục</th>
                        <th>Giá</th>
                        <th>Tồn Kho</th>
                        <th>Bán Được</th>
                        <th>Trạng Thái</th>
                        <th style="width: 150px;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="font-semibold text-gray-900">{{ $product->id }}</td>
                        <td>
                            <div class="font-semibold text-gray-900">{{ $product->name }}</div>
                            <div class="text-xs text-gray-600">SKU: {{ $product->sku ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <span class="text-sm text-blue-600">{{ $product->category->name ?? 'N/A' }}</span>
                        </td>
                        <td class="text-green-600 font-semibold">{{ number_format($product->price, 0, ',', '.') }}đ</td>
                        <td>
                            <span class="text-yellow-600">{{ $product->quantity_in_stock }}</span>
                        </td>
                        <td>
                            <span class="text-blue-600">{{ $product->sold_count }}</span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                @if($product->is_active)
                                    <span class="badge badge-success">Hoạt động</span>
                                @else
                                    <span class="badge badge-danger">Tắt</span>
                                @endif
                                @if($product->is_featured)
                                    <span class="badge badge-info">Nổi bật</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800 text-sm" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display:inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 text-sm" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-blue-200">
            {{ $products->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center py-12 text-gray-600">
            <i class="fas fa-inbox text-4xl mb-4 block opacity-50"></i>
            <p>Không tìm thấy sản phẩm nào</p>
        </div>
    @endif
</div>
@endsection
