@extends('layouts.admin')

@section('title', 'Quản Lý Sản Phẩm')
@section('page-title', 'Danh Sách Sản Phẩm')
@section('page-subtitle', 'Quản lý toàn bộ sản phẩm và kho hàng')

@section('content')
<div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">

    <!-- Header & Actions -->
    <div style="display: flex; justify-content: space-between; align-items: center; gap: var(--sp-xl); flex-wrap: wrap;">
        <div>
            <h2 style="margin: 0; font-size: 20px; font-weight: 600;">Sản Phẩm ({{ $products->total() ?? 0 }} tổng)</h2>
            <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--text-muted);">{{ $products->count() }} đang hiển thị</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            <span>Thêm Sản Phẩm</span>
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="panel" style="padding: var(--sp-xl);">
        <form method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--sp-lg); align-items: flex-end;">
            <div>
                <label style="margin-bottom: var(--sp-sm);">Tìm kiếm sản phẩm</label>
                <input type="text" name="search" placeholder="Tên, SKU, hoặc mô tả..." value="{{ request('search') }}" style="width: 100%;">
            </div>
            <div>
                <label style="margin-bottom: var(--sp-sm);">Danh mục</label>
                <select name="category" style="width: 100%;">
                    <option value="">Tất cả danh mục</option>
                    @isset($categories)
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <div>
                <label style="margin-bottom: var(--sp-sm);">Trạng thái</label>
                <select name="status" style="width: 100%;">
                    <option value="">Tất cả</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang bán</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Ngừng bán</option>
                </select>
            </div>
            <div style="display: flex; gap: var(--sp-lg);">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    <i class="fas fa-search"></i>
                    <span>Tìm</span>
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="flex: 1; justify-content: center;">
                    <i class="fas fa-redo-alt"></i>
                    <span>Đặt lại</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    @if($products->count() > 0)
        <div class="panel" style="overflow: hidden;">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sản Phẩm</th>
                        <th>Danh Mục</th>
                        <th>Giá</th>
                        <th>Màu</th>
                        <th>Size</th>
                        <th>Tồn Kho</th>
                        <th>Trạng Thái</th>
                        <th style="text-align: right; width: 120px;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <span style="font-size: 12px; color: var(--text-muted);">#{{ $product->id }}</span>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: var(--sp-lg);">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 40px; height: 40px; border-radius: var(--radius-md); object-fit: cover; border: var(--border-thin);">
                                    @else
                                        <div style="width: 40px; height: 40px; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(0,212,255,0.1), rgba(139,92,246,0.1)); display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                            <i class="fas fa-image" style="font-size: 14px;"></i>
                                        </div>
                                    @endif
                                    <div style="min-width: 0;">
                                        <p style="margin: 0; font-size: 14px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->name }}</p>
                                        <p style="margin: 2px 0 0 0; font-size: 12px; color: var(--text-muted);">ID: {{ $product->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 13px;">{{ $product->category->name ?? '—' }}</span>
                            </td>
                            <td>
                                <span style="font-size: 14px; font-weight: 600; color: var(--laser-blue);">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                            </td>
                            <td>
                                <span style="font-size: 13px;">{{ $product->colors->count() }} màu</span>
                            </td>
                            <td>
                                <span style="font-size: 13px;">{{ $product->sizes->count() }} size</span>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: var(--sp-sm);">
                                    <span style="font-size: 14px; font-weight: 600;">{{ $product->quantity_in_stock }}</span>
                                    @if($product->quantity_in_stock > 20)
                                        <span class="badge badge-success">
                                            <span class="badge-dot"></span>
                                            Còn
                                        </span>
                                    @elseif($product->quantity_in_stock > 5)
                                        <span class="badge badge-warning">
                                            <span class="badge-dot"></span>
                                            Ít
                                        </span>
                                    @else
                                        <span class="badge badge-error">
                                            <span class="badge-dot"></span>
                                            Hết
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($product->is_active)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle" style="font-size: 10px;"></i>
                                        Đang bán
                                    </span>
                                @else
                                    <span class="badge badge-error">
                                        <i class="fas fa-times-circle" style="font-size: 10px;"></i>
                                        Ngừng bán
                                    </span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <div style="display: flex; gap: var(--sp-sm); justify-content: flex-end;">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary" style="padding: 8px 12px; font-size: 12px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: inline;" onsubmit="return confirm('Xóa sản phẩm này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 8px 12px; font-size: 12px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="display: flex; justify-content: center;">
            {{ $products->links('pagination::tailwind') }}
        </div>
    @else
        <!-- Empty State -->
        <div class="panel" style="padding: var(--sp-3xl) var(--sp-xl); text-align: center;">
            <div style="display: flex; justify-content: center; margin-bottom: var(--sp-xl);">
                <div style="width: 64px; height: 64px; border-radius: var(--radius-lg); background: linear-gradient(135deg, rgba(0,212,255,0.1), rgba(139,92,246,0.1)); display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 32px;">
                    <i class="fas fa-box"></i>
                </div>
            </div>
            <h3 style="margin: 0 0 var(--sp-md) 0; font-size: 18px; font-weight: 600;">Chưa có sản phẩm</h3>
            <p style="margin: 0 0 var(--sp-xl) 0; color: var(--text-secondary);">Bắt đầu bằng cách tạo sản phẩm đầu tiên cho cửa hàng của bạn.</p>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <span>Tạo Sản Phẩm</span>
            </a>
        </div>
    @endif
</div>
@endsection
