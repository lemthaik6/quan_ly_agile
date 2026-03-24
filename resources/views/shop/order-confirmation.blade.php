@extends('layouts.shop')

@section('title', 'Xác Nhận Đơn Hàng')

@section('content')
<div style="margin-top: 40px; text-align: center;">
    <div class="fade-in" style="margin-bottom: 80px;">
        <div style="font-size: 80px; margin-bottom: 20px; animation: bounce 2s infinite;">✅</div>
        <h1 class="glow-text" style="font-size: 48px; margin-bottom: 15px;">Đơn Hàng Thành Công!</h1>
        <p style="color: #00f5ff; font-size: 18px; margin-bottom: 30px;">Cảm ơn bạn đã mua sắm tại LEMTHAI Store</p>
    </div>

    <div class="grid grid-cols-2" style="max-width: 1000px; margin: 0 auto; gap: 30px;">
        <!-- Order Info -->
        <div class="card" style="text-align: left;">
            <h3 style="color: #00f5ff; margin-bottom: 20px; font-size: 18px;">📋 Thông Tin Đơn Hàng</h3>

            <div style="background: rgba(0, 245, 255, 0.05); border-left: 3px solid #00f5ff; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                <div style="font-size: 12px; color: #999; margin-bottom: 5px;">MÃ ĐƠN HÀNG</div>
                <div style="font-size: 18px; color: #00f5ff; font-weight: bold; font-family: 'Courier New';">{{ $order->order_code }}</div>
            </div>

            <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.1);">
                <div style="font-size: 12px; color: #999;">Ngày Đặt</div>
                <div style="color: #00f5ff;">{{ $order->created_at->format('d/m/Y H:i') }}</div>
            </div>

            <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.1);">
                <div style="font-size: 12px; color: #999;">Trạng Thái Đơn</div>
                <div style="display: inline-block; background: rgba(0, 102, 255, 0.2); color: #0066ff; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                    ⏳ Đang Xử Lý
                </div>
            </div>

            <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.1);">
                <div style="font-size: 12px; color: #999;">Phương Thức Thanh Toán</div>
                <div style="color: #00f5ff;">
                    @if($order->payment_method === 'cod')
                        💵 Thanh Toán Khi Nhận (COD)
                    @else
                        🏦 Chuyển Khoản Ngân Hàng
                    @endif
                </div>
            </div>

            <div>
                <div style="font-size: 12px; color: #999;">Địa Chỉ Giao Hàng</div>
                <div style="color: #ccc;">
                    {{ $order->shipping_address }}<br>
                    {{ $order->shipping_district }}, {{ $order->shipping_city }}
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="card" style="text-align: left;">
            <h3 style="color: #00f5ff; margin-bottom: 20px; font-size: 18px;">📦 Chi Tiết Đơn Hàng</h3>

            <div style="max-height: 200px; overflow-y: auto; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid rgba(0, 245, 255, 0.2);">
                @foreach($order->orderItems as $item)
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 13px;">
                        <div style="flex: 1;">
                            <div style="color: #00f5ff; font-weight: 600;">{{ Str::limit($item->product->name, 40) }}</div>
                            <div style="color: #999; margin-top: 3px;">
                                @if($item->selected_color)
                                    Màu: {{ $item->selected_color }} |
                                @endif
                                @if($item->selected_size)
                                    Kích cỡ: {{ $item->selected_size }} |
                                @endif
                                Số lượng: {{ $item->quantity }}
                            </div>
                        </div>
                        <div style="text-align: right; min-width: 100px;">
                            <div style="color: #00f5ff; font-weight: 600;">{{ number_format($item->subtotal, 0, ',', '.') }}đ</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid rgba(0, 245, 255, 0.1); margin-bottom: 10px;">
                <span style="color: #999;">Tạm tính:</span>
                <span>{{ number_format($order->subtotal, 0, ',', '.') }}đ</span>
            </div>

            <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid rgba(0, 245, 255, 0.1); margin-bottom: 10px;">
                <span style="color: #999;">Phí vận chuyển:</span>
                <span>{{ number_format($order->shipping_fee, 0, ',', '.') }}đ</span>
            </div>

            @if($order->discount_amount > 0)
                <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid rgba(0, 245, 255, 0.1); margin-bottom: 10px;">
                    <span style="color: #999;">Chiết khấu:</span>
                    <span style="color: #22c55e;">-{{ number_format($order->discount_amount, 0, ',', '.') }}đ</span>
                </div>
            @endif

            <div style="display: flex; justify-content: space-between; font-size: 16px; color: #00f5ff; font-weight: bold;">
                <span>Tổng cộng:</span>
                <span>{{ number_format($order->final_amount, 0, ',', '.') }}đ</span>
            </div>
        </div>
    </div>

    <!-- Next Steps -->
    <div class="card fade-in" style="max-width: 800px; margin: 40px auto; background: rgba(0, 102, 255, 0.1); border: 1px solid rgba(0, 102, 255, 0.3);">
        <h3 style="color: #00f5ff; margin-bottom: 20px; font-size: 18px;">📝 Các Bước Tiếp Theo</h3>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div style="text-align: center;">
                <div style="font-size: 32px; margin-bottom: 10px;">📨</div>
                <div style="color: #999; font-size: 13px;">
                    <strong style="color: #00f5ff;">Bước 1:</strong> Xác nhận đơn sẽ được gửi đến email của bạn
                </div>
            </div>

            <div style="text-align: center;">
                <div style="font-size: 32px; margin-bottom: 10px;">🚚</div>
                <div style="color: #999; font-size: 13px;">
                    <strong style="color: #00f5ff;">Bước 2:</strong> Chúng tôi sẽ chuẩn bị đơn hàng trong 24 giờ
                </div>
            </div>

            <div style="text-align: center;">
                <div style="font-size: 32px; margin-bottom: 10px;">🎯</div>
                <div style="color: #999; font-size: 13px;">
                    <strong style="color: #00f5ff;">Bước 3:</strong> Theo dõi trạng thái giao hàng sau
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div style="display: flex; justify-content: center; gap: 15px; margin: 40px 0;">
        <a href="{{ route('order.show', $order->order_code) }}" class="btn btn-primary">
            🔍 Xem Chi Tiết Đơn Hàng
        </a>
        <a href="{{ route('shop.index') }}" class="btn btn-secondary">
            🛍️ Tiếp Tục Mua Sắm
        </a>
    </div>
</div>

<style>
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
</style>
@endsection
