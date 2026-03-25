@extends('layouts.admin')

@section('title', 'Quản Lý Danh Mục')
@section('page-title', 'Danh Mục Sản Phẩm')
@section('page-subtitle', 'Quản lý tất cả danh mục')

@section('content')
<div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">

    <!-- Header & Actions -->
    <div style="display: flex; justify-content: space-between; align-items: center; gap: var(--sp-xl); flex-wrap: wrap;">
        <div>
            <h2 style="margin: 0; font-size: 20px; font-weight: 600;">Danh Mục ({{ $categories->count() }} total)</h2>
            <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--text-muted);">Quản lý cấu trúc sản phẩm</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            <span>Thêm Danh Mục</span>
        </a>
    </div>

    <!-- Categories Grid -->
    @if($categories->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: var(--sp-xl);">
            @forelse($categories as $category)
                <div class="panel-elevated" style="padding: var(--sp-xl); display: flex; flex-direction: column; gap: var(--sp-lg);">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-md);">
                            <h3 style="margin: 0; font-size: 16px; font-weight: 600; color: var(--text-primary);">{{ $category->name }}</h3>
                            @if($category->is_active)
                                <span class="badge badge-success">
                                    <span class="badge-dot"></span>
                                    Active
                                </span>
                            @else
                                <span class="badge badge-error">
                                    <span class="badge-dot"></span>
                                    Inactive
                                </span>
                            @endif
                        </div>
                        <p style="margin: 0; font-size: 12px; color: var(--text-muted); min-height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $category->description ?? '—' }}</p>
                    </div>

                    <div style="padding-top: var(--sp-lg); border-top: var(--border-thin); display: flex; justify-content: space-between; items-center;">
                        <div>
                            <p style="margin: 0; font-size: 12px; color: var(--text-muted);">Sản phẩm</p>
                            <p style="margin: 4px 0 0 0; font-size: 16px; font-weight: 600; color: var(--laser-blue);">{{ $category->products_count ?? 0 }}</p>
                        </div>
                        <div style="display: flex; gap: var(--sp-sm);">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-secondary" style="padding: 8px 12px; font-size: 12px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display: inline;" onsubmit="return confirm('Xóa danh mục?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 8px 12px; font-size: 12px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    @else
        <!-- Empty State -->
        <div class="panel" style="padding: var(--sp-3xl) var(--sp-xl); text-align: center;">
            <div style="display: flex; justify-content: center; margin-bottom: var(--sp-xl);">
                <div style="width: 64px; height: 64px; border-radius: var(--radius-lg); background: linear-gradient(135deg, rgba(0,212,255,0.1), rgba(139,92,246,0.1)); display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 32px;">
                    <i class="fas fa-folder"></i>
                </div>
            </div>
            <h3 style="margin: 0 0 var(--sp-md) 0; font-size: 18px; font-weight: 600;">Không có danh mục</h3>
            <p style="margin: 0 0 var(--sp-xl) 0; color: var(--text-secondary);">Tạo danh mục đầu tiên để tổ chức sản phẩm.</p>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <span>Tạo Danh Mục</span>
            </a>
        </div>
    @endif
</div>
@endsection
