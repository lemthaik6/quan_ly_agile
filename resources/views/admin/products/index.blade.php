@extends('layouts.admin')

@section('title', 'Quản Lý Sản Phẩm')

@section('content')
<div class="space-y-6">
    <h1 class="text-3xl font-bold">Danh Sách Sản Phẩm</h1>
    
    <!-- Search & Filter -->
    <div class="bg-white p-4 rounded-lg shadow">
        <form method="GET" class="flex gap-4">
            <input type="text" name="search" placeholder="Tìm sản phẩm..." value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
            
            <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Tìm kiếm</button>
            <a href="{{ route('admin.products.create') }}" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Thêm mới</a>
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Tên sản phẩm</th>
                    <th class="px-6 py-3 text-left">Danh mục</th>
                    <th class="px-6 py-3 text-left">Giá</th>
                    <th class="px-6 py-3 text-left">Tồn kho</th>
                    <th class="px-6 py-3 text-left">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $product->name }}</td>
                        <td class="px-6 py-3">{{ $product->category->name ?? 'N/A' }}</td>
                        <td class="px-6 py-3">{{ number_format($product->price, 0, ',', '.') }} ₫</td>
                        <td class="px-6 py-3">{{ $product->quantity_in_stock }}</td>
                        <td class="px-6 py-3">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline">Sửa</a>
                            |
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-3 text-center text-gray-500">Không có sản phẩm nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
