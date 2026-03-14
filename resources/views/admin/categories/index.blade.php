@extends('layouts.admin')

@section('title', 'Quản Lý Danh Mục')

@section('content')
<div class="space-y-6">
    <h1 class="text-3xl font-bold">Danh Sách Danh Mục</h1>
    
    <!-- Search Form -->
    <div class="bg-white p-4 rounded-lg shadow">
        <form method="GET" class="flex gap-4">
            <input type="text" name="search" placeholder="Tìm danh mục..." value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Tìm kiếm</button>
            <a href="{{ route('admin.categories.create') }}" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Thêm mới</a>
        </form>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Tên danh mục</th>
                    <th class="px-6 py-3 text-left">Mô tả</th>
                    <th class="px-6 py-3 text-left">Trạng thái</th>
                    <th class="px-6 py-3 text-left">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $category->name }}</td>
                        <td class="px-6 py-3">{{ Str::limit($category->description, 50) }}</td>
                        <td class="px-6 py-3">
                            <span class="px-3 py-1 rounded-full text-sm {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $category->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:underline">Sửa</a>
                            |
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display:inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-3 text-center text-gray-500">Không có danh mục nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>
@endsection
