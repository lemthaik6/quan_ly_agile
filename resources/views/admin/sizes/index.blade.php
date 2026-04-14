@extends('layouts.admin')

@section('title', 'Quản Lý Kích Cỡ')
@section('page-title', 'Quản Lý Kích Cỡ')
@section('page-subtitle', 'Danh sách kích cỡ có thể gán cho sản phẩm')

@section('content')
<div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: var(--sp-xl); flex-wrap: wrap;">
        <div>
            <h2 style="margin: 0; font-size: 20px; font-weight: 600;">Kích cỡ ({{ $sizes->total() ?? 0 }} tổng)</h2>
            <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--text-muted);">{{ $sizes->count() }} đang hiển thị</p>
        </div>
        <a href="{{ route('admin.sizes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            <span>Thêm Size</span>
        </a>
    </div>

    <div class="panel" style="overflow: hidden;">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên size</th>
                    <th>Trạng thái</th>
                    <th style="text-align: right; width: 120px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sizes as $size)
                    <tr>
                        <td><span style="font-size: 12px; color: var(--text-muted);">#{{ $size->id }}</span></td>
                        <td>{{ $size->name }}</td>
                        <td>
                            @if($size->is_active)
                                <span class="badge badge-success">Hoạt động</span>
                            @else
                                <span class="badge badge-error">Ngưng</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: var(--sp-sm); justify-content: flex-end;">
                                <a href="{{ route('admin.sizes.edit', $size) }}" class="btn btn-secondary" style="padding: 8px 12px; font-size: 12px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.sizes.destroy', $size) }}" style="display:inline;" onsubmit="return confirm('Xóa kích cỡ này?');">
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

    <div style="display: flex; justify-content: center;">{{ $sizes->links('pagination::tailwind') }}</div>
</div>
@endsection
