@extends('layouts.admin')

@section('title', 'Quản Lý Danh Mục')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center flex-wrap gap-4">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Danh Sách Danh Mục</h1>
            <p class="text-gray-500 mt-1">Quản lý danh mục sản phẩm</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-2 px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Thêm Danh Mục
        </a>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <form method="GET" class="flex gap-4 flex-wrap">
            <div class="flex-1 min-w-[250px] relative">
                <svg class="w-5 h-5 absolute left-3 top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" placeholder="Tìm danh mục..." value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Tìm kiếm
            </button>
        </form>
    </div>

    <!-- Categories Grid -->
    @if($categories->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all border border-gray-100 overflow-hidden">
            <!-- Top Color Bar -->
            <div class="h-1 bg-gradient-to-r from-cyan-500 to-blue-600"></div>
            
            <!-- Icon Area -->
            <div class="h-24 bg-gradient-to-br from-cyan-50 to-blue-50 flex items-center justify-center group-hover:bg-cyan-100 transition-colors">
                <svg class="w-12 h-12 text-cyan-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z"/>
                </svg>
            </div>

            <!-- Content -->
            <div class="p-5">
                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-cyan-600 transition-colors">{{ $category->name }}</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $category->description ?? 'Chưa có mô tả' }}</p>

                <!-- Status -->
                <div class="mb-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $category->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        <span class="w-2 h-2 rounded-full {{ $category->is_active ? 'bg-green-600' : 'bg-red-600' }}"></span>
                        {{ $category->is_active ? 'Hoạt động' : 'Ngừng hoạt động' }}
                    </span>
                </div>

                <!-- Actions -->
                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="flex-1 flex items-center justify-center gap-2 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors font-medium text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Sửa
                    </a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="flex-1" onsubmit="return confirm('Xóa danh mục này?');">
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
        {{ $categories->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16 bg-white rounded-xl shadow-md border border-gray-100">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Chưa có danh mục</h3>
        <p class="text-gray-500 mb-6">Bắt đầu bằng cách tạo danh mục sản phẩm đầu tiên</p>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-white rounded-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tạo Danh Mục
        </a>
    </div>
    @endif
</div>
@endsection
