@extends('layouts.admin')

@section('title', 'Quản Lý Màu')
@section('page-title', 'Quản Lý Màu')
@section('page-subtitle', 'Danh sách màu sắc có thể gán cho sản phẩm')

@section('content')
<div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: var(--sp-xl); flex-wrap: wrap;">
        <div>
            <h2 style="margin: 0; font-size: 20px; font-weight: 600;">Màu sắc ({{ $colors->total() ?? 0 }} tổng)</h2>
            <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--text-muted);">{{ $colors->count() }} đang hiển thị</p>
        </div>
        <a href="{{ route('admin.colors.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            <span>Thêm Màu</span>
        </a>
    </div>

    <div class="panel" style="overflow: hidden;">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên màu</th>
                    <th>HEX</th>
                    <th>Trạng thái</th>
                    <th style="text-align: right; width: 120px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colors as $color)
                    <tr>
                        <td><span style="font-size: 12px; color: var(--text-muted);">#{{ $color->id }}</span></td>
                        <td>{{ $color->name }}</td>
                        <td><span style="display: inline-flex; align-items: center; gap: 0.5rem;
                            padding: 5px 10px; border-radius: 999px; background: rgba(255,255,255,0.05);">
                            <span style="width: 18px; height: 18px; border-radius: 999px; display: inline-block; background: {{ $color->hex_code }}; border: 1px solid rgba(255,255,255,0.12);"></span>
                            {{ $color->hex_code }}
                        </span></td>
                        <td>
                            @if($color->is_active)
                                <span class="badge badge-success">Hoạt động</span>
                            @else
                                <span class="badge badge-error">Ngưng</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: var(--sp-sm); justify-content: flex-end;">
                                <a href="{{ route('admin.colors.edit', $color) }}" class="btn btn-secondary" style="padding: 8px 12px; font-size: 12px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.colors.destroy', $color) }}" style="display:inline;" onsubmit="return confirm('Xóa màu này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 8px 12px; font-size: 12px;">
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

    <div style="display: flex; justify-content: center;">{{ $colors->links('pagination::tailwind') }}</div>
</div>
@endsection
