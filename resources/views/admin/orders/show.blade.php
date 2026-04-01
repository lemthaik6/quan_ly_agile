@extends('layouts.admin')

@section('title', 'Chi Tiết Đơn Hàng #' . ($order->order_number ?? $order->id))
@section('page-title', 'Đơn Hàng')
@section('page-subtitle', '#' . ($order->order_number ?? $order->id))

@section('content')
<div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">

    <!-- Header + Status Bar -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-lg); align-items: start;">
        <div>
            <h2 style="margin: 0; font-size: 24px; font-weight: 600;">Đơn Hàng #{{ $order->order_number ?? $order->id }}</h2>
            <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--text-muted);">{{ $order->created_at->format('d/m/Y H:i:s') }}</p>
        </div>
        <div style="display: flex; gap: var(--sp-md); justify-content: flex-end;">
            @switch($order->order_status)
                @case('dang_cho')
                    <span class="badge badge-warning" style="padding: 8px 12px; font-size: 12px;">Chờ xác nhận</span>
                    @break
                @case('dang_xu_ly')
                    <span class="badge badge-info" style="padding: 8px 12px; font-size: 12px;">Đang xử lý</span>
                    @break
                @case('dang_giao')
                    <span class="badge badge-info" style="padding: 8px 12px; font-size: 12px;">Đang giao</span>
                    @break
                @case('da_giao')
                    <span class="badge badge-success" style="padding: 8px 12px; font-size: 12px;">Đã giao</span>
                    @break
                @case('da_huy')
                    <span class="badge badge-error" style="padding: 8px 12px; font-size: 12px;">Đã hủy</span>
                    @break
            @endswitch
            @switch($order->payment_status)
                @case('dang_cho')
                    <span class="badge badge-warning" style="padding: 8px 12px; font-size: 12px;">Chờ thanh toán</span>
                    @break
                @case('hoan_thanh')
                    <span class="badge badge-success" style="padding: 8px 12px; font-size: 12px;">Đã thanh toán</span>
                    @break
                @case('that_bai')
                    <span class="badge badge-error" style="padding: 8px 12px; font-size: 12px;">Thanh toán lỗi</span>
                    @break
            @endswitch
        </div>
    </div>

    <!-- Main Grid: 2/3 Content + 1/3 Sidebar -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: var(--sp-2xl);">

        <!-- Main Content -->
        <div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">

            <!-- Customer Section -->
            <div class="panel" style="padding: var(--sp-xl);">
                <h3 style="margin: 0 0 var(--sp-lg) 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--laser-blue);">
                    <i class="fas fa-user"></i> Khách Hàng
                </h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-lg);">
                    <div>
                        <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Tên</p>
                        <p style="margin: 0; font-size: 13px; font-weight: 600;">{{ $order->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Email</p>
                        <p style="margin: 0; font-size: 13px;">{{ $order->user->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase;">SĐT</p>
                        <p style="margin: 0; font-size: 13px;">{{ $order->user->phone_number ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Địa Chỉ</p>
                        <p style="margin: 0; font-size: 13px;">{{ $order->shipping_address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items Section -->
            <div class="panel" style="overflow: hidden;">
                <div style="padding: var(--sp-xl); border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <h3 style="margin: 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--laser-blue);">
                        <i class="fas fa-box"></i> Sản Phẩm
                    </h3>
                </div>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Sản Phẩm</th>
                            <th>Giá</th>
                            <th>SL</th>
                            <th style="text-align: right;">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->orderItems as $item)
                            <tr>
                                <td>
                                    <div>
                                        <p style="margin: 0; font-size: 13px; font-weight: 600;">{{ $item->product->name ?? 'N/A' }}</p>
                                        <p style="margin: 2px 0 0 0; font-size: 11px; color: var(--text-muted);">
                                            @if($item->color)
                                                <span>{{ $item->color->name }}</span>
                                            @endif
                                            @if($item->size)
                                                <span> • {{ $item->size->name }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <span style="font-size: 13px; font-weight: 600;">{{ number_format($item->price, 0, ',', '.') }}₫</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px;">x{{ $item->quantity }}</span>
                                </td>
                                <td style="text-align: right;">
                                    <span style="font-size: 13px; font-weight: 600; color: var(--laser-blue);">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</span>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Payment Section -->
            <div class="panel" style="padding: var(--sp-xl);">
                <h3 style="margin: 0 0 var(--sp-lg) 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--laser-blue);">
                    <i class="fas fa-credit-card"></i> Thanh Toán
                </h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-lg); border-top: 1px solid rgba(255,255,255,0.08); padding-top: var(--sp-lg);">
                    <div>
                        <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase;">PP Thanh Toán</p>
                        <p style="margin: 0; font-size: 13px; font-weight: 600;">
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
                        </p>
                    </div>
                    <div>
                        <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Trạng Thái</p>
                        @switch($order->payment_status)
                            @case('dang_cho')
                                <span class="badge badge-warning">Chờ thanh toán</span>
                                @break
                            @case('hoan_thanh')
                                <span class="badge badge-success">Đã thanh toán</span>
                                @break
                            @case('that_bai')
                                <span class="badge badge-error">Thanh toán lỗi</span>
                                @break
                        @endswitch
                    </div>
                    <div>
                        <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Ghi Chú</p>
                        <p style="margin: 0; font-size: 13px;">{{ $order->payment_note ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Shipping Section -->
            <div class="panel" style="padding: var(--sp-xl);">
                <h3 style="margin: 0 0 var(--sp-lg) 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--laser-blue);">
                    <i class="fas fa-truck"></i> Vận Chuyển
                </h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-lg); border-top: 1px solid rgba(255,255,255,0.08); padding-top: var(--sp-lg);">
                    <div>
                        <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Địa Chỉ Giao</p>
                        <p style="margin: 0; font-size: 13px;">{{ $order->shipping_address ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Trạng Thái</p>
                        @switch($order->order_status)
                            @case('dang_cho')
                                <span class="badge badge-warning">Chờ xác nhận</span>
                                @break
                            @case('dang_xu_ly')
                                <span class="badge badge-info">Đang xử lý</span>
                                @break
                            @case('dang_giao')
                                <span class="badge badge-info">Đang giao</span>
                                @break
                            @case('da_giao')
                                <span class="badge badge-success">Đã giao</span>
                                @break
                            @case('da_huy')
                                <span class="badge badge-error">Đã hủy</span>
                                @break
                        @endswitch
                    </div>
                </div>

                <!-- Tracking Timeline -->
                <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: var(--sp-lg); margin-top: var(--sp-lg);">
                    <h4 style="margin: 0 0 var(--sp-lg) 0; font-size: 12px; font-weight: 600; color: var(--text-muted);">LỊCH SỬ VẬN CHUYỂN</h4>
                    <div style="display: flex; flex-direction: column; gap: var(--sp-lg);">
                        @if($order->orderTrackings && count($order->orderTrackings) > 0)
                            @foreach($order->orderTrackings as $tracking)
                                <div style="display: flex; gap: var(--sp-lg);">
                                    <div style="position: relative; padding-top: 2px;">
                                        <div style="width: 12px; height: 12px; border-radius: 50%; background: linear-gradient(135deg, var(--laser-blue), #00a8cc); border: 2px solid var(--carbon); margin-left: 0;"></div>
                                    </div>
                                    <div style="flex: 1; padding-bottom: var(--sp-lg);">
                                        <p style="margin: 0; font-size: 13px; font-weight: 600;">{{ $tracking->status_label ?? $tracking->status ?? 'N/A' }}</p>
                                        <p style="margin: 2px 0 0 0; font-size: 11px; color: var(--text-muted);">{{ $tracking->created_at->format('d/m/Y H:i') }}</p>
                                        <p style="margin: 4px 0 0 0; font-size: 12px; color: var(--text-secondary);">{{ $tracking->note }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p style="margin: 0; font-size: 12px; color: var(--text-muted);">Chưa có lịch sử vận chuyển</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">

            <!-- Price Summary -->
            <div class="panel" style="padding: var(--sp-xl);">
                <h3 style="margin: 0 0 var(--sp-lg) 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--laser-blue);">
                    Tổng Cộng
                </h3>
                <div style="display: flex; flex-direction: column; gap: var(--sp-lg); border-top: 1px solid rgba(255,255,255,0.08); padding-top: var(--sp-lg);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 12px; color: var(--text-muted);">Tiền hàng</span>
                        <span style="font-size: 13px; font-weight: 600;">{{ number_format($order->subtotal ?? 0, 0, ',', '.') }}₫</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 12px; color: var(--text-muted);">Vận chuyển</span>
                        <span style="font-size: 13px; font-weight: 600;">{{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}₫</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 12px; color: var(--text-muted);">Discount</span>
                        <span style="font-size: 13px; font-weight: 600; color: var(--electric-violet);">-{{ number_format($order->discount_amount ?? 0, 0, ',', '.') }}₫</span>
                    </div>
                    <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: var(--sp-lg); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Tổng</span>
                        <span style="font-size: 18px; font-weight: 700; color: var(--laser-blue);">{{ number_format($order->final_amount, 0, ',', '.') }}₫</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="panel" style="padding: var(--sp-xl);">
                <h3 style="margin: 0 0 var(--sp-lg) 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--laser-blue);">
                    Hành Động
                </h3>
                <div style="display: flex; flex-direction: column; gap: var(--sp-md); border-top: 1px solid rgba(255,255,255,0.08); padding-top: var(--sp-lg);">
                    <button class="btn btn-primary" onclick="document.getElementById('toggle-order-status').style.display = document.getElementById('toggle-order-status').style.display === 'none' ? 'block' : 'none';" style="width: 100%; justify-content: center;">
                        <i class="fas fa-sync-alt"></i>
                        <span>Cập Nhật Trạng Thái</span>
                    </button>
                    <button class="btn btn-secondary" onclick="document.getElementById('toggle-payment-status').style.display = document.getElementById('toggle-payment-status').style.display === 'none' ? 'block' : 'none';" style="width: 100%; justify-content: center;">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Cập Nhật Thanh Toán</span>
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary" style="width: 100%; justify-content: center;">
                        <i class="fas fa-arrow-left"></i>
                        <span>Quay Lại</span>
                    </a>
                </div>
            </div>

            <!-- Status Update Form (Hidden) -->
            <form id="toggle-order-status" style="display: none;" class="panel" style="padding: var(--sp-xl);" action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                @csrf
                <select name="order_status" style="width: 100%; margin-bottom: var(--sp-lg);">
                    <option value="">Chọn trạng thái</option>
                    <option value="dang_cho">Chờ xác nhận</option>
                    <option value="dang_xu_ly">Đang xử lý</option>
                    <option value="dang_giao">Đang giao</option>
                    <option value="da_giao">Đã giao</option>
                    <option value="da_huy">Đã hủy</option>
                </select>
                <textarea name="description" placeholder="Ghi chú..." style="width: 100%; height: 80px; padding: var(--sp-md); background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; color: var(--text-primary); margin-bottom: var(--sp-lg);"></textarea>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                    <i class="fas fa-check"></i>
                    <span>Lưu</span>
                </button>
            </form>

            <!-- Payment Status Form (Hidden) -->
            <form id="toggle-payment-status" style="display: none;" class="panel" style="padding: var(--sp-xl);" action="{{ route('admin.orders.update-payment-status', $order->id) }}" method="POST">
                @csrf
                <select name="payment_status" style="width: 100%; margin-bottom: var(--sp-lg);">
                    <option value="">Chọn trạng thái</option>
                    <option value="dang_cho">Chờ thanh toán</option>
                    <option value="hoan_thanh">Đã thanh toán</option>
                    <option value="that_bai">Thanh toán lỗi</option>
                </select>
                <textarea name="description" placeholder="Ghi chú..." style="width: 100%; height: 80px; padding: var(--sp-md); background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; color: var(--text-primary); margin-bottom: var(--sp-lg);"></textarea>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                    <i class="fas fa-check"></i>
                    <span>Lưu</span>
                </button>
            </form>

        </div>

    </div>

</div>

<style>
    #toggle-order-status, #toggle-payment-status {
        padding: var(--sp-xl);
    }
</style>
@endsection
