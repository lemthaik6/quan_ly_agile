@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng')
@section('page-title', 'Chi Tiết Đơn Hàng')
@section('page-subtitle', 'Mã ĐH: #' . $order->order_number)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Thông tin cơ bản -->
        <div class="card">
            <h2 class="text-xl font-orbitron font-bold text-cyan-400 mb-6">Thông Tin Đơn Hàng</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div>
                    <p class="text-gray-400 text-sm">Mã Đơn Hàng</p>
                    <p class="text-white font-bold">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Khách Hàng</p>
                    <p class="text-white font-bold">{{ $order->user->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Ngày Đặt</p>
                    <p class="text-white font-bold">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Tổng Tiền</p>
                    <p class="text-green-400 font-bold">{{ number_format($order->final_amount, 0, ',', '.') }}đ</p>
                </div>
            </div>

            <hr class="border-cyan-400/10 mb-6">

            <!-- Địa chỉ giao hàng -->
            <h3 class="font-bold text-white mb-4">Địa Chỉ Giao Hàng</h3>
            <div class="bg-cyan-400/5 p-4 rounded-lg border border-cyan-400/10">
                <p class="text-white"><strong>{{ $order->shipping_name }}</strong></p>
                <p class="text-gray-300">{{ $order->shipping_address }}</p>
                <p class="text-gray-300">{{ $order->shipping_ward ?? '' }}, {{ $order->shipping_district }}, {{ $order->shipping_city }}</p>
                <p class="text-gray-300">Mã bưu điện: {{ $order->shipping_postal_code ?? 'N/A' }}</p>
                <p class="text-cyan-400">{{ $order->shipping_phone }}</p>
                @if($order->shipping_email)
                    <p class="text-cyan-400">{{ $order->shipping_email }}</p>
                @endif
            </div>
        </div>

        <!-- Chi tiết sản phẩm -->
        <div class="card">
            <h2 class="text-xl font-orbitron font-bold text-cyan-400 mb-6">Sản Phẩm Đơn Hàng</h2>
            
            <div class="overflow-x-auto">
                <table>
                    <thead>
                        <tr>
                            <th>Sản Phẩm</th>
                            <th class="text-right">Số Lượng</th>
                            <th class="text-right">Đơn Giá</th>
                            <th class="text-right">Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <a href="{{ route('admin.products.edit', $item->product_id) }}" class="text-cyan-400 hover:text-cyan-300">
                                    {{ $item->product_name }}
                                </a>
                            </td>
                            <td class="text-right">{{ $item->quantity }}</td>
                            <td class="text-right">{{ number_format($item->unit_price, 0, ',', '.') }}đ</td>
                            <td class="text-right font-bold">{{ number_format($item->total_price, 0, ',', '.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 space-y-2 text-right">
                <div class="flex justify-end gap-4">
                    <span>Tổng sản phẩm:</span>
                    <span class="font-bold">{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                </div>
                @if($order->discount_amount > 0)
                    <div class="flex justify-end gap-4 text-orange-400">
                        <span>Giảm giá:</span>
                        <span class="font-bold">-{{ number_format($order->discount_amount, 0, ',', '.') }}đ</span>
                    </div>
                @endif
                @if($order->shipping_cost > 0)
                    <div class="flex justify-end gap-4 text-cyan-400">
                        <span>Vận chuyển:</span>
                        <span class="font-bold">{{ number_format($order->shipping_cost, 0, ',', '.') }}đ</span>
                    </div>
                @endif
                <div class="flex justify-end gap-4 text-green-400 font-bold text-lg">
                    <span>Tổng cộng:</span>
                    <span>{{ number_format($order->final_amount, 0, ',', '.') }}đ</span>
                </div>
            </div>
        </div>

        <!-- Lịch sử theo dõi -->
        <div class="card">
            <h2 class="text-xl font-orbitron font-bold text-cyan-400 mb-6">Lịch Sử Theo Dõi</h2>
            
            @if($order->tracking->count() > 0)
                <div class="space-y-4">
                    @foreach($order->tracking->sortByDesc('created_at') as $track)
                        <div class="flex gap-4 pb-4 border-b border-cyan-400/10 last:border-b-0">
                            <div class="flex-shrink-0">
                                <div class="w-3 h-3 bg-cyan-400 rounded-full mt-1.5"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="font-semibold text-white">
                                        @switch($track->status)
                                            @case('dang_cho')
                                                Đơn hàng chờ xử lý
                                                @break
                                            @case('da_xac_nhan')
                                                Đơn hàng đã xác nhận
                                                @break
                                            @case('dang_xu_ly')
                                                Đơn hàng đang chuẩn bị
                                                @break
                                            @case('da_gui')
                                                Đơn hàng đã gửi
                                                @break
                                            @case('da_giao')
                                                Đơn hàng đã giao từ
                                                @break
                                            @case('da_huy')
                                                Đơn hàng bị hủy
                                                @break
                                        @endswitch
                                    </h4>
                                    <span class="text-xs text-gray-500">{{ $track->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                @if($track->description)
                                    <p class="text-sm text-gray-300">{{ $track->description }}</p>
                                @endif
                                @if($track->location)
                                    <p class="text-xs text-cyan-400 mt-1">📍 {{ $track->location }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-8">Chưa có lịch sử theo dõi</p>
            @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Cập nhật trạng thái -->
        <div class="card">
            <h3 class="font-bold text-white mb-4">Cập Nhật Trạng Thái</h3>
            
            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm text-gray-400 block mb-2">Trạng Thái Đơn Hàng</label>
                    <select name="order_status" class="w-full bg-cyan-400/5 border border-cyan-400/20 rounded-lg px-3 py-2 text-white">
                        <option value="dang_cho" {{ $order->order_status == 'dang_cho' ? 'selected' : '' }}>Đang chờ</option>
                        <option value="da_xac_nhan" {{ $order->order_status == 'da_xac_nhan' ? 'selected' : '' }}>Đã xác nhận</option>
                        <option value="dang_xu_ly" {{ $order->order_status == 'dang_xu_ly' ? 'selected' : '' }}>Đang xử lý</option>
                        <option value="da_gui" {{ $order->order_status == 'da_gui' ? 'selected' : '' }}>Đã gửi</option>
                        <option value="da_giao" {{ $order->order_status == 'da_giao' ? 'selected' : '' }}>Đã giao</option>
                        <option value="da_huy" {{ $order->order_status == 'da_huy' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-400 block mb-2">Ghi Chú (tuỳ chọn)</label>
                    <textarea name="description" rows="3" placeholder="Nhập ghi chú..." class="w-full bg-cyan-400/5 border border-cyan-400/20 rounded-lg px-3 py-2 text-white text-sm"></textarea>
                </div>

                <button type="submit" class="btn-primary w-full">
                    <i class="fas fa-check mr-2"></i> Cập Nhật
                </button>
            </form>
        </div>

        <!-- Trạng thái thanh toán -->
        <div class="card">
            <h3 class="font-bold text-white mb-4">Thanh Toán</h3>
            
            <div class="mb-4">
                <p class="text-sm text-gray-400">Phương Thức</p>
                <p class="text-white font-semibold">
                    @switch($order->payment_method)
                        @case('cod')
                            💵 Tiền mặt (COD)
                            @break
                        @case('chuyen_khoan')
                            🏦 Chuyển khoản
                            @break
                        @case('the_tin_dung')
                            💳 Thẻ tín dụng
                            @break
                        @case('vi_dien_tu')
                            📱 Ví điện tử
                            @break
                    @endswitch
                </p>
            </div>

            <form method="POST" action="{{ route('admin.orders.update-payment-status', $order->id) }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm text-gray-400 block mb-2">Trạng Thái Thanh Toán</label>
                    <select name="payment_status" class="w-full bg-cyan-400/5 border border-cyan-400/20 rounded-lg px-3 py-2 text-white">
                        <option value="dang_cho" {{ $order->payment_status == 'dang_cho' ? 'selected' : '' }}>Chưa thanh toán</option>
                        <option value="hoan_thanh" {{ $order->payment_status == 'hoan_thanh' ? 'selected' : '' }}>Đã thanh toán</option>
                        <option value="that_bai" {{ $order->payment_status == 'that_bai' ? 'selected' : '' }}>Thất bại</option>
                        <option value="hoan_tien" {{ $order->payment_status == 'hoan_tien' ? 'selected' : '' }}>Hoàn tiền</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary w-full">
                    <i class="fas fa-save mr-2"></i> Lưu
                </button>
            </form>
        </div>

        <!-- Hành động -->
        <div class="card">
            <h3 class="font-bold text-white mb-4">Hành Động</h3>
            
            <div class="space-y-2">
                @if($order->order_status != 'da_huy')
                    <form method="POST" action="{{ route('admin.orders.cancel', $order->id) }}" onsubmit="return confirm('Hủy đơn hàng?');">
                        @csrf
                        <button type="submit" class="btn-danger w-full">
                            <i class="fas fa-times mr-2"></i> Hủy Đơn Hàng
                        </button>
                    </form>
                @endif
                
                <a href="{{ route('admin.orders.export', $order->id) }}" class="btn-secondary w-full block text-center">
                    <i class="fas fa-download mr-2"></i> Xuất PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
