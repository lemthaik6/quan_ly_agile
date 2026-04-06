@extends('layouts.shop')

@section('title', 'Đơn Hàng Của Tôi')

@section('content')
<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
    <!-- Page Header -->
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 42px; font-weight: 700; background: linear-gradient(135deg, #f0f0f0, #00d4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px;">📦 Đơn Hàng Của Tôi</h1>
        <p style="color: #b0b0c0; font-size: 14px;">Theo dõi tất cả đơn hàng của bạn</p>
    </div>

    @if($activeOrders->count() > 0)
        <!-- Active Orders Section -->
        <div style="margin-bottom: 40px;">
            <h2 style="font-size: 18px; font-weight: 700; color: #f0f0f0; margin-bottom: 16px;">✓ Đơn Hàng Hoạt Động</h2>
            <!-- Orders Grid -->
            <div style="display: grid; gap: 16px; margin-bottom: 40px;">
                @foreach($activeOrders as $order)
                    <div class="fade-in" style="background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)); border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; backdrop-filter: blur(20px); padding: 24px; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.borderColor='rgba(0,212,255,0.4)'; this.style.boxShadow='0 12px 32px rgba(0,212,255,0.1)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.boxShadow='';">
                        
                        <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto auto; gap: 24px; align-items: center;">
                            
                            <!-- Order Info -->
                            <div>
                                <a href="{{ route('order.show', $order->order_code) }}" style="text-decoration: none; color: inherit;">
                                    <div style="color: #00d4ff; font-weight: 600; font-size: 15px; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                                        <span>Đơn</span>
                                        <span style="font-size: 13px; background: rgba(0,212,255,0.15); padding: 4px 10px; border-radius: 6px; letter-spacing: 0.5px; font-family: 'Monaco', monospace;">{{ $order->order_code }}</span>
                                    </div>
                                </a>
                                <p style="color: #808090; font-size: 13px; margin-bottom: 8px;">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                <p style="color: #b0b0c0; font-size: 13px;">{{ $order->orderItems->count() }} sản phẩm • {{ $order->orderItems->sum('quantity') }} cái</p>
                            </div>

                            <!-- Amount -->
                            <div>
                                <div style="font-size: 12px; color: #808090; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Tổng</div>
                                <div style="font-size: 18px; font-weight: 700; background: linear-gradient(135deg, #00d4ff, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ number_format($order->final_amount, 0, ',', '.') }}đ</div>
                            </div>

                            <!-- Payment Status -->
                            <div>
                                <div style="font-size: 12px; color: #808090; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Thanh Toán</div>
                                @if($order->payment_status === 'hoan_thanh')
                                    <span style="background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(16,185,129,0.1)); color: #86efac; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;display: inline-block;">✓ Đã Thanh Toán</span>
                                @elseif($order->payment_status === 'dang_xu_ly')
                                    <span style="background: linear-gradient(135deg, rgba(234,179,8,0.2), rgba(234,179,8,0.1)); color: #fde047; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;display: inline-block;">⏳ Chờ Xử Lý</span>
                                @else
                                    <span style="background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(239,68,68,0.1)); color: #fca5a5; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;display: inline-block;">✗ Chưa Thanh Toán</span>
                                @endif
                            </div>

                            <!-- Order Status -->
                            <div>
                                <div style="font-size: 12px; color: #808090; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Trạng Thái</div>
                                @if($order->order_status === 'da_giao')
                                    <span style="background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(16,185,129,0.1)); color: #86efac; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">✓ Đã Giao</span>
                                @elseif($order->order_status === 'dang_giao')
                                    <span style="background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(59,130,246,0.1)); color: #93c5fd; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;display: inline-block;">📦 Đang Giao</span>
                                @elseif($order->order_status === 'da_huy')
                                    <span style="background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(239,68,68,0.1)); color: #fca5a5; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;display: inline-block;">✗ Đã Hủy</span>
                                @else
                                    <span style="background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(0,212,255,0.1)); color: #00d4ff; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;display: inline-block;">⏳ Đang Xử Lý</span>
                                @endif
                            </div>

                            <!-- View Detail Button -->
                            <a href="{{ route('order.show', $order->order_code) }}" style="background: linear-gradient(135deg, #00d4ff, #8b5cf6); color: #080808; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 600; font-size: 13px; cursor: pointer; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(0,212,255,0.4)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
                                Chi Tiết →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($activeOrders->hasPages())
                <div style="display: flex; justify-content: center; gap: 8px; margin-top: 40px;">
                    {{ $activeOrders->links() }}
                </div>
            @endif
        </div>
    @else
        <!-- Empty State -->
        <div style="background: linear-gradient(135deg, rgba(0,212,255,0.1), rgba(139,92,246,0.05)); border: 1px solid rgba(0,212,255,0.2); border-radius: 14px; backdrop-filter: blur(20px); padding: 80px 40px; text-align: center;">
            <div style="font-size: 100px; margin-bottom: 20px;">📦</div>
            <h2 style="font-size: 24px; font-weight: 700; color: #f0f0f0; margin-bottom: 12px;">Bạn chưa có đơn hàng nào</h2>
            <p style="color: #b0b0c0; font-size: 14px; margin-bottom: 32px;">Bắt đầu mua sắm ngay và tạo đơn hàng đầu tiên của bạn</p>
            <a href="{{ route('shop.index') }}" style="background: linear-gradient(135deg, #00d4ff, #8b5cf6); color: #080808; border: none; border-radius: 10px; padding: 12px 32px; font-weight: 600; font-size: 15px; cursor: pointer; text-decoration: none; display: inline-block; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(0,212,255,0.4)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
                🛍️ Khám Phá Sản Phẩm
            </a>
        </div>
    @endif

    <!-- Canceled Orders Section (Collapsible) -->
    @if($canceledOrders->count() > 0)
        <div style="margin-top: 40px;">
            <button onclick="toggleCanceled()" style="background: linear-gradient(135deg, rgba(239,68,68,0.15), rgba(239,68,68,0.08)); color: #ef4444; border: 1px solid rgba(239,68,68,0.3); border-radius: 10px; padding: 12px 20px; font-weight: 600; font-size: 14px; cursor: pointer; width: 100%; text-align: left; transition: all 0.3s; display: flex; align-items: center; gap: 12px;" onmouseover="this.style.background='rgba(239,68,68,0.25)'; this.style.borderColor='rgba(239,68,68,0.5)';" onmouseout="this.style.background='rgba(239,68,68,0.15)'; this.style.borderColor='rgba(239,68,68,0.3)';">
                <span id="canceledToggleIcon" style="transition: transform 0.3s;">▶</span>
                <span>✗ Đơn Hàng Đã Hủy ({{ $canceledOrders->count() }})</span>
            </button>

            <div id="canceledOrdersSection" style="display: none; margin-top: 16px;">
                <!-- Canceled Orders Grid -->
                <div style="display: grid; gap: 16px;">
                    @foreach($canceledOrders as $order)
                        <div class="fade-in" style="background: linear-gradient(135deg, rgba(239,68,68,0.1), rgba(239,68,68,0.05)); border: 1px solid rgba(239,68,68,0.2); border-radius: 14px; backdrop-filter: blur(20px); padding: 24px; opacity: 0.8;">
                            
                            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto auto; gap: 24px; align-items: center;">
                                
                                <!-- Order Info -->
                                <div>
                                    <a href="{{ route('order.show', $order->order_code) }}" style="text-decoration: none; color: inherit;">
                                        <div style="color: #ef4444; font-weight: 600; font-size: 15px; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                                            <span>Đơn</span>
                                            <span style="font-size: 13px; background: rgba(239,68,68,0.15); padding: 4px 10px; border-radius: 6px; letter-spacing: 0.5px; font-family: 'Monaco', monospace;">{{ $order->order_code }}</span>
                                        </div>
                                    </a>
                                    <p style="color: #808090; font-size: 13px; margin-bottom: 8px;">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    <p style="color: #b0b0c0; font-size: 13px;">{{ $order->orderItems->count() }} sản phẩm • {{ $order->orderItems->sum('quantity') }} cái</p>
                                </div>

                                <!-- Amount -->
                                <div>
                                    <div style="font-size: 12px; color: #808090; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Tổng</div>
                                    <div style="font-size: 18px; font-weight: 700; color: #ef4444;">{{ number_format($order->final_amount, 0, ',', '.') }}đ</div>
                                </div>

                                <!-- Payment Status -->
                                <div>
                                    <div style="font-size: 12px; color: #808090; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Thanh Toán</div>
                                    @if($order->payment_status === 'hoan_thanh')
                                        <span style="background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(16,185,129,0.1)); color: #86efac; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;display: inline-block;">✓ Đã Thanh Toán</span>
                                    @else
                                        <span style="background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(239,68,68,0.1)); color: #fca5a5; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;display: inline-block;">✗ Chưa Thanh Toán</span>
                                    @endif
                                </div>

                                <!-- Order Status -->
                                <div>
                                    <div style="font-size: 12px; color: #808090; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Trạng Thái</div>
                                    <span style="background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(239,68,68,0.1)); color: #fca5a5; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;display: inline-block;">✗ Đã Hủy</span>
                                </div>

                                <!-- View Detail Button -->
                                <a href="{{ route('order.show', $order->order_code) }}" style="background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(239,68,68,0.1)); color: #ef4444; border: 1px solid rgba(239,68,68,0.3); border-radius: 10px; padding: 10px 20px; font-weight: 600; font-size: 13px; cursor: pointer; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.background='rgba(239,68,68,0.3)'; this.style.borderColor='rgba(239,68,68,0.5)';" onmouseout="this.style.background='rgba(239,68,68,0.2)'; this.style.borderColor='rgba(239,68,68,0.3)';">
                                    Chi Tiết →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function toggleCanceled() {
        const section = document.getElementById('canceledOrdersSection');
        const icon = document.getElementById('canceledToggleIcon');
        
        if (section.style.display === 'none') {
            section.style.display = 'block';
            icon.style.transform = 'rotate(90deg)';
        } else {
            section.style.display = 'none';
            icon.style.transform = 'rotate(0deg)';
        }
    }
</script>
@endsection
