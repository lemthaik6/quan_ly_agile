@extends('layouts.admin')

@section('title', 'Quản lý danh mục')
@section('page-title', 'Quản Lý Danh Mục')
@section('page-subtitle', 'Danh sách tất cả danh mục sản phẩm')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-orbitron font-bold text-white">Danh Sách Danh Mục</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Thêm Danh Mục
    </a>
</div>

<!-- Filters -->
<div class="card mb-6">
    <form method="GET" action="{{ route('admin.categories.index') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <input type="text" name="search" placeholder="Tìm kiếm danh mục..." 
                       value="{{ request('search') }}"
                       class="w-full bg-cyan-400/5 border border-cyan-400/20 rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 btn-primary">
                    <i class="fas fa-search mr-2"></i> Tìm Kiếm
                </button>
                <a href="{{ route('admin.categories.index') }}" class="flex-1 btn-secondary">
                    <i class="fas fa-redo mr-2"></i> Đặt Lại
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Table -->
<div class="card overflow-hidden">
    @if($categories->count() > 0)
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Tên Danh Mục</th>
                        <th>Slug</th>
                        <th>Sản Phẩm</th>
                        <th>Thứ Tự</th>
                        <th>Trạng Thái</th>
                        <th style="width: 150px;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td class="font-semibold">{{ $category->id }}</td>
                        <td>
                            <div class="font-semibold text-white">{{ $category->name }}</div>
                            @if($category->description)
                                <div class="text-xs text-gray-400 mt-1">{{ Str::limit($category->description, 50) }}</div>
                            @endif
                        </td>
                        <td class="text-gray-400 text-sm">{{ $category->slug }}</td>
                        <td>
                            <span class="text-cyan-400 font-semibold">{{ $category->products()->count() }}</span>
                        </td>
                        <td class="text-center">
                            {{ $category->display_order ?? '-' }}
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="badge badge-success">Hoạt động</span>
                            @else
                                <span class="badge badge-danger">Tắt</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($category->products()->count() == 0)
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" style="display:inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-cyan-400/10">
            {{ $categories->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center py-12 text-gray-400">
            <i class="fas fa-inbox text-4xl mb-4 block opacity-50"></i>
            <p>Không tìm thấy danh mục nào</p>
        </div>
    @endif
</div>
@endsection
