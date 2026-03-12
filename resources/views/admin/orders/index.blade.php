@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')
@section('page-title', 'Quản Lý Đơn Hàng')
@section('page-subtitle', 'Danh sách tất cả đơn hàng từ khách hàng')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-orbitron font-bold text-white">Danh Sách Đơn Hàng</h2>
</div>

<!-- Filters -->
<div class="card mb-6">
    <form method="GET" action="{{ route('admin.orders.index') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" name="search" placeholder="Tìm mã ĐH hoặc khách hàng..." 
                       value="{{ request('search') }}"
                       class="w-full bg-cyan-400/5 border border-cyan-400/20 rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400">
            </div>
            <div>
                <select name="status" class="w-full bg-cyan-400/5 border border-cyan-400/20 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-cyan-400">
                    <option value="">Tất cả trạng thái</option>
                    <option value="dang_cho" {{ request('status') == 'dang_cho' ? 'selected' : '' }}>Đang chờ</option>
                    <option value="da_xac_nhan" {{ request('status') == 'da_xac_nhan' ? 'selected' : '' }}>Đã xác nhận</option>
                    <option value="dang_xu_ly" {{ request('status') == 'dang_xu_ly' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="da_gui" {{ request('status') == 'da_gui' ? 'selected' : '' }}>Đã gửi</option>
                    <option value="da_giao" {{ request('status') == 'da_giao' ? 'selected' : '' }}>Đã giao</option>
                    <option value="da_huy" {{ request('status') == 'da_huy' ? 'selected' : '' }}>Đã hủy</option>
                </select>
            </div>
            <div>
                <select name="payment_status" class="w-full bg-cyan-400/5 border border-cyan-400/20 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-cyan-400">
                    <option value="">Tất cả thanh toán</option>
                    <option value="dang_cho" {{ request('payment_status') == 'dang_cho' ? 'selected' : '' }}>Chưa thanh toán</option>
                    <option value="hoan_thanh" {{ request('payment_status') == 'hoan_thanh' ? 'selected' : '' }}>Đã thanh toán</option>
                    <option value="that_bai" {{ request('payment_status') == 'that_bai' ? 'selected' : '' }}>Thất bại</option>
                    <option value="hoan_tien" {{ request('payment_status') == 'hoan_tien' ? 'selected' : '' }}>Hoàn tiền</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 btn-primary">
                    <i class="fas fa-filter mr-2"></i> Lọc
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn-secondary">
                    <i class="fas fa-redo mr-2"></i> Đặt Lại
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Table -->
<div class="card overflow-hidden">
    @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Mã ĐH</th>
                        <th>Khách Hàng</th>
                        <th>Tổng Tiền</th>
                        <th>Pt. Thanh Toán</th>
                        <th>Trạng Thái ĐH</th>
                        <th>Thanh Toán</th>
                        <th>Đặt Hàng</th>
                        <th style="width: 100px;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="font-semibold text-cyan-400">#{{ $order->order_number }}</td>
                        <td>
                            <div class="text-white font-semibold">{{ $order->user->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-400">{{ $order->user->email ?? '' }}</div>
                        </td>
                        <td class="text-green-400 font-bold">{{ number_format($order->final_amount, 0, ',', '.') }}đ</td>
                        <td class="text-sm">
                            @switch($order->payment_method)
                                @case('cod')
                                    <span class="text-gray-300">Tiền mặt</span>
                                    @break
                                @case('chuyen_khoan')
                                    <span class="text-cyan-400">Chuyển khoản</span>
                                    @break
                                @case('the_tin_dung')
                                    <span class="text-cyan-400">Thẻ tín dụng</span>
                                    @break
                                @case('vi_dien_tu')
                                    <span class="text-cyan-400">Ví điện tử</span>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            @switch($order->order_status)
                                @case('dang_cho')
                                    <span class="badge badge-warning">Đang chờ</span>
                                    @break
                                @case('da_xac_nhan')
                                    <span class="badge badge-info">Đã xác nhận</span>
                                    @break
                                @case('dang_xu_ly')
                                    <span class="badge badge-info">Đang xử lý</span>
                                    @break
                                @case('da_gui')
                                    <span class="badge badge-info">Đã gửi</span>
                                    @break
                                @case('da_giao')
                                    <span class="badge badge-success">Đã giao</span>
                                    @break
                                @case('da_huy')
                                    <span class="badge badge-danger">Đã hủy</span>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            @switch($order->payment_status)
                                @case('dang_cho')
                                    <span class="badge badge-warning">Chưa ttc</span>
                                    @break
                                @case('hoan_thanh')
                                    <span class="badge badge-success">Đã ttc</span>
                                    @break
                                @case('that_bai')
                                    <span class="badge badge-danger">Lỗi</span>
                                    @break
                                @case('hoan_tien')
                                    <span class="badge badge-info">Hoàn tiền</span>
                                    @break
                            @endswitch
                        </td>
                        <td class="text-xs text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm">
                                <i class="fas fa-eye mr-1"></i> Chi tiết
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-cyan-400/10">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center py-12 text-gray-400">
            <i class="fas fa-inbox text-4xl mb-4 block opacity-50"></i>
            <p>Không tìm thấy đơn hàng nào</p>
        </div>
    @endif
</div>
@endsection
