@extends('layouts.admin')

@section('title', 'Quản Lý Sản Phẩm')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center flex-wrap gap-4">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Danh Sách Sản Phẩm</h1>
            <p class="text-gray-500 mt-1">Quản lý kho hàng và chi tiết sản phẩm</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2 px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Thêm Sản Phẩm
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="relative">
                <svg class="w-5 h-5 absolute left-3 top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" placeholder="Tìm sản phẩm..." value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none">
            </div>
            <select name="category" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none">
                <option value="">Tất cả danh mục</option>
                @isset($categories)
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                @endisset
            </select>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Tìm kiếm
            </button>
        </form>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all border border-gray-100 overflow-hidden">
            <!-- Top Color Bar -->
            <div class="h-1 bg-gradient-to-r from-cyan-500 to-blue-600"></div>

            <!-- Product Image -->
            <div class="h-40 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center overflow-hidden relative group-hover:from-gray-100">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                @else
                    <svg class="w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                @endif

                <!-- Stock Badge -->
                <div class="absolute top-3 right-3">
                    @if($product->quantity_in_stock > 20)
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg">
                            <span class="w-2 h-2 bg-green-200 rounded-full animate-pulse"></span>
                            Còn hàng
                        </span>
                    @elseif($product->quantity_in_stock > 0)
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-amber-500 text-white text-xs font-bold rounded-full shadow-lg">
                            <span class="w-2 h-2 bg-amber-200 rounded-full animate-pulse"></span>
                            Sắp hết
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-500 text-white text-xs font-bold rounded-full shadow-lg">
                            <span class="w-2 h-2 bg-red-200 rounded-full animate-pulse"></span>
                            Hết hàng
                        </span>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="p-5">
                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-cyan-600 transition-colors line-clamp-2">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500 mb-3">{{ $product->category->name ?? 'Chưa phân loại' }}</p>

                <!-- Price -->
                <div class="text-2xl font-bold text-cyan-600 mb-3">{{ number_format($product->price, 0, ',', '.') }}₫</div>

                <!-- Stock & Status -->
                <div class="space-y-2 mb-4 pb-4 border-b border-gray-100">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Tồn kho:</span>
                        <span class="font-semibold text-gray-900">{{ $product->quantity_in_stock }} {{ $product->unit ?? 'cái' }}</span>
                    </div>
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            <span class="w-2 h-2 rounded-full {{ $product->is_active ? 'bg-green-600' : 'bg-red-600' }}"></span>
                            {{ $product->is_active ? 'Đang bán' : 'Ngừng bán' }}
                        </span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 flex items-center justify-center gap-2 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors font-medium text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Sửa
                    </a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="flex-1" onsubmit="return confirm('Xóa sản phẩm này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors font-medium text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex justify-center pt-6">
        {{ $products->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16 bg-white rounded-xl shadow-md border border-gray-100">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Chưa có sản phẩm</h3>
        <p class="text-gray-500 mb-6">Bắt đầu bằng cách tạo sản phẩm đầu tiên</p>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-white rounded-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tạo Sản Phẩm
        </a>
    </div>
    @endif
</div>
@endsection
