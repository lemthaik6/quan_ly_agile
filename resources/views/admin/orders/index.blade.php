@extends('layouts.admin')

@section('title', 'Quản Lý Đơn Hàng')
@section('page-title', 'Đơn Hàng')
@section('page-subtitle', 'Quản lý tất cả đơn hàng từ khách hàng')

@section('content')
<div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">

    <!-- Header -->
    <div>
        <h2 style="margin: 0; font-size: 20px; font-weight: 600;">Tất Cả Đơn Hàng</h2>
        <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--text-muted);">{{ $orders->total() ?? 0 }} tổng | {{ $orders->count() }} hiển thị</p>
    </div>

    <!-- Filters -->
    <div class="panel" style="padding: var(--sp-xl);">
        <form method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: var(--sp-lg); align-items: flex-end;">
            <div>
                <label style="margin-bottom: var(--sp-sm);">Tìm kiếm</label>
                <input type="text" name="search" placeholder="Mã ĐH, name, email..." value="{{ request('search') }}" style="width: 100%;">
            </div>
            <div>
                <label style="margin-bottom: var(--sp-sm);">Trạng thái đơn</label>
                <select name="status" style="width: 100%;">
                    <option value="">Tất cả</option>
                    <option value="dang_cho" {{ request('status') == 'dang_cho' ? 'selected' : '' }}>Đang chờ</option>
                    <option value="da_xac_nhan" {{ request('status') == 'da_xac_nhan' ? 'selected' : '' }}>Đã xác nhận</option>
                    <option value="dang_xu_ly" {{ request('status') == 'dang_xu_ly' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="da_gui" {{ request('status') == 'da_gui' ? 'selected' : '' }}>Đã gửi</option>
                    <option value="da_giao" {{ request('status') == 'da_giao' ? 'selected' : '' }}>Đã giao</option>
                    <option value="da_huy" {{ request('status') == 'da_huy' ? 'selected' : '' }}>Đã hủy</option>
                </select>
            </div>
            <div>
                <label style="margin-bottom: var(--sp-sm);">Thanh toán</label>
                <select name="payment_status" style="width: 100%;">
                    <option value="">Tất cả</option>
                    <option value="dang_cho" {{ request('payment_status') == 'dang_cho' ? 'selected' : '' }}>Chưa ttc</option>
                    <option value="hoan_thanh" {{ request('payment_status') == 'hoan_thanh' ? 'selected' : '' }}>Đã ttc</option>
                    <option value="that_bai" {{ request('payment_status') == 'that_bai' ? 'selected' : '' }}>Lỗi</option>
                </select>
            </div>
            <div style="display: flex; gap: var(--sp-lg);">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    <i class="fas fa-search"></i>
                    <span>Lọc</span>
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary" style="flex: 1; justify-content: center;">
                    <i class="fas fa-redo-alt"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    @if($orders->count() > 0)
        <div class="panel" style="overflow: hidden;">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Khách Hàng</th>
                        <th>Tổng Tiền</th>
                        <th>PP Thanh Toán</th>
                        <th>Trạng Thái</th>
                        <th>Thanh Toán</th>
                        <th>Ngày</th>
                        <th style="text-align: right; width: 100px;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <span style="font-weight: 600; color: var(--laser-blue);">#{{ $order->order_number ?? $order->id }}</span>
                            </td>
                            <td>
                                <div>
                                    <p style="margin: 0; font-size: 13px; font-weight: 600;">{{ $order->user->name ?? 'N/A' }}</p>
                                    <p style="margin: 2px 0 0 0; font-size: 11px; color: var(--text-muted);">{{ $order->user->email ?? '' }}</p>
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 14px; font-weight: 600; color: var(--laser-blue);">{{ number_format($order->final_amount, 0, ',', '.') }}₫</span>
                            </td>
                            <td>
                                <span style="font-size: 12px;">
                                    @switch($order->payment_method)
                                        @case('cod')
                                            Tiền mặt
                                            @break
                                        @case('chuyen_khoan')
                                            Chuyển khoản
                                            @break
                                        @case('the_tin_dung')
                                            Thẻ tín dụng
                                            @break
                                        @case('vi_dien_tu')
                                            Ví điện tử
                                            @break
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                @switch($order->order_status)
                                    @case('dang_cho')
                                        <span class="badge badge-warning">Chờ</span>
                                        @break
                                    @case('da_xac_nhan')
                                        <span class="badge badge-info">Xác nhận</span>
                                        @break
                                    @case('dang_xu_ly')
                                        <span class="badge badge-info">Xử lý</span>
                                        @break
                                    @case('da_gui')
                                        <span class="badge badge-info">Gửi</span>
                                        @break
                                    @case('da_giao')
                                        <span class="badge badge-success">Giao</span>
                                        @break
                                    @case('da_huy')
                                        <span class="badge badge-error">Hủy</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @switch($order->payment_status)
                                    @case('dang_cho')
                                        <span class="badge badge-warning">Chờ</span>
                                        @break
                                    @case('hoan_thanh')
                                        <span class="badge badge-success">Đã ttc</span>
                                        @break
                                    @case('that_bai')
                                        <span class="badge badge-error">Lỗi</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <span style="font-size: 12px; color: var(--text-muted);">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary" style="padding: 8px 12px; font-size: 12px;">
                                    <i class="fas fa-eye"></i>
                                    <span>Xem</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="display: flex; justify-content: center;">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    @else
        <!-- Empty State -->
        <div class="panel" style="padding: var(--sp-3xl) var(--sp-xl); text-align: center;">
            <i class="fas fa-inbox" style="font-size: 48px; color: var(--text-muted); margin-bottom: var(--sp-xl); display: block;"></i>
            <h3 style="margin: 0 0 var(--sp-md) 0; font-size: 18px; font-weight: 600;">Không có đơn hàng</h3>
            <p style="margin: 0; color: var(--text-secondary);">Chưa có đơn hàng nào phù hợp với bộ lọc.</p>
        </div>
    @endif
</div>
@endsection
