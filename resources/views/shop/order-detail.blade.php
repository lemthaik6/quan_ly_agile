@extends('layouts.shop')

@section('title', 'Chi Tiết Đơn Hàng - ' . $order->order_code)

@section('content')
<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
    <!-- Breadcrumb -->
    <div style="margin-bottom: 30px; display: flex; align-items: center; gap: 8px;">
        <a href="{{ route('order.list') }}" style="color: #00d4ff; text-decoration: none; font-size: 14px; font-weight: 600;">← Danh Sách Đơn Hàng</a>
    </div>

    <!-- Page Header -->
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 42px; font-weight: 700; background: linear-gradient(135deg, #f0f0f0, #00d4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px;">📋 Đơn {{ $order->order_code }}</h1>
        <p style="color: #b0b0c0; font-size: 14px;">Đặt lúc {{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Timeline & Details -->
        <div>
            <!-- Basic Info Card -->
            <div style="background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)); border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; backdrop-filter: blur(20px); padding: 24px; margin-bottom: 24px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div>
                        <div style="font-size: 12px; color: #808090; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Mã Đơn Hàng</div>
                        <div style="font-family: 'Monaco', monospace; font-size: 14px; font-weight: 600; color: #00d4ff;">{{ $order->order_code }}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: #808090; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Phương Thức Thanh Toán</div>
                        <div style="color: #b0b0c0; font-size: 14px;">@if($order->payment_method === 'cod') 💵 Thanh Toán Khi Nhận @else 🏦 Chuyển Khoản @endif</div>
                    </div>
                </div>
            </div>

            <!-- Tracking Timeline -->
            <div style="background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)); border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; backdrop-filter: blur(20px); padding: 24px; margin-bottom: 24px;">
                <h3 style="font-size: 16px; font-weight: 700; color: #f0f0f0; margin-bottom: 24px;">🚚 Theo Dõi Đơn Hàng</h3>

                <div style="position: relative; padding-left: 0;">
                    @php
                        $statuses = [
                            ['status' => 'pending', 'label' => 'Đơn Hàng Được Tạo', 'icon' => '📝'],
                            ['status' => 'confirmed', 'label' => 'Đã Xác Nhận', 'icon' => '✓'],
                            ['status' => 'preparing', 'label' => 'Đang Chuẩn Bị', 'icon' => '📦'],
                            ['status' => 'shipped', 'label' => 'Đang Giao Hàng', 'icon' => '🚚'],
                            ['status' => 'completed', 'label' => 'Hoàn Thành', 'icon' => '🎉'],
                        ];
                        $statusOrder = ['pending' => 0, 'confirmed' => 1, 'preparing' => 2, 'shipped' => 3, 'completed' => 4];
                        $currentStatusIndex = $statusOrder[$order->order_status] ?? 0;
                    @endphp

                    @foreach($statuses as $index => $status)
                        @php
                            $statusIndex = $statusOrder[$status['status']];
                            $isActive = $statusIndex <= $currentStatusIndex;
                            $tracking = $order->trackings->where('status', $status['status'])->first();
                        @endphp
                        <div style="display: flex; gap: 20px; margin-bottom: @if($index < count($statuses) - 1) 32px @else 0 @endif; position: relative;">
                            <!-- Timeline Line -->
                            @if($index < count($statuses) - 1)
                                <div style="position: absolute; left: 19px; top: 60px; width: 2px; height: 32px; background: linear-gradient(to bottom, {{ $isActive ? 'rgba(0,212,255,0.4)' : 'rgba(255,255,255,0.1)' }}, {{ $statusIndex + 1 <= $currentStatusIndex ? 'rgba(0,212,255,0.4)' : 'rgba(255,255,255,0.1)' }});"></div>
                            @endif

                            <!-- Status Dot -->
                            <div style="width: 40px; height: 40px; min-width: 40px; border-radius: 50%; background: {{ $isActive ? 'linear-gradient(135deg, rgba(0,212,255,0.3), rgba(0,212,255,0.1))' : 'rgba(255,255,255,0.05)' }}; border: 2px solid {{ $isActive ? '#00d4ff' : 'rgba(255,255,255,0.2)' }}; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: {{ $isActive ? '0 0 15px rgba(0,212,255,0.3)' : 'none' }}; transition: all 0.3s;">
                                {{ $status['icon'] }}
                            </div>

                            <!-- Status Info -->
                            <div style="flex: 1; padding-top: 4px;">
                                <h4 style="font-size: 14px; font-weight: 600; color: {{ $isActive ? '#f0f0f0' : '#808090' }}; margin-bottom: 4px;">{{ $status['label'] }}</h4>
                                <p style="font-size: 12px; color: #b0b0c0;">
                                    @if($tracking)
                                        {{ $tracking->created_at->format('d/m/Y H:i') }}
                                    @else
                                        Chờ cập nhật
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- All Tracking Logs -->
                @if($order->trackings->count() > 0)
                    <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid rgba(0,212,255,0.2);">
                        <h4 style="font-size: 13px; font-weight: 600; color: #00d4ff; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 16px;">Nhật Ký Cập Nhật</h4>
                        <div style="max-height: 250px; overflow-y: auto; display: flex; flex-direction: column; gap: 12px;">
                            @foreach($order->trackings as $tracking)
                                <div style="padding: 12px; background: linear-gradient(135deg, rgba(0,212,255,0.1), rgba(0,212,255,0.05)); border-left: 3px solid #00d4ff; border-radius: 6px;">
                                    <div style="font-size: 12px; font-weight: 600; color: #00d4ff; margin-bottom: 4px;">{{ $tracking->created_at->format('d/m/Y H:i') }}</div>
                                    <div style="font-size: 12px; color: #b0b0c0;">{{ ucfirst($tracking->status) }}@if($tracking->description) - {{ $tracking->description }}@endif</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Order Items -->
            <div style="background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)); border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; backdrop-filter: blur(20px); padding: 24px; margin-bottom: 24px;">
                <h3 style="font-size: 16px; font-weight: 700; color: #f0f0f0; margin-bottom: 20px;">📦 Chi Tiết Sản Phẩm</h3>

                <div style="display: flex; flex-direction: column; gap: 16px;">
                    @foreach($order->orderItems as $item)
                        <div style="display: flex; gap: 16px; padding: 16px; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.08); border-radius: 10px; transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(0,212,255,0.3)'; this.style.background='rgba(0,212,255,0.05)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.background='rgba(255,255,255,0.02)';">
                            <!-- Image -->
                            <div style="width: 100px; height: 100px; background: rgba(0,212,255,0.1); border-radius: 10px; overflow: hidden; flex-shrink: 0;">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #00d4ff; font-size: 20px;">📦</div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div style="flex: 1;">
                                <a href="{{ route('product.show', $item->product->slug) }}" style="text-decoration: none; color: inherit;">
                                    <h4 style="color: #f0f0f0; font-size: 14px; font-weight: 600; margin-bottom: 8px;">{{ $item->product->name }}</h4>
                                </a>
                                <p style="font-size: 12px; color: #b0b0c0; margin-bottom: 8px;">
                                    @if($item->selected_color) <span style="background: rgba(0,212,255,0.1); padding: 2px 6px; border-radius: 4px;">{{ $item->selected_color }}</span> @endif
                                    @if($item->selected_size) <span style="background: rgba(0,212,255,0.1); padding: 2px 6px; border-radius: 4px; margin-left: 4px;">{{ $item->selected_size }}</span> @endif
                                    <span style="color: #808090; margin-left: 8px;">× {{ $item->quantity }}</span>
                                </p>
                                <div style="font-size: 14px; font-weight: 600; background: linear-gradient(135deg, #00d4ff, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ number_format($item->subtotal, 0, ',', '.') }}đ</div>

                                <!-- Review Button -->
                                @if($order->order_status === 'completed' && !$item->reviews()->where('user_id', auth()->id())->exists())
                                    <a href="{{ route('review.create', $item->product->slug) }}" style="display: inline-block; margin-top: 8px; background: rgba(0,212,255,0.15); color: #00d4ff; border: 1px solid rgba(0,212,255,0.3); padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='rgba(0,212,255,0.25)'; this.style.borderColor='rgba(0,212,255,0.5)';" onmouseout="this.style.background='rgba(0,212,255,0.15)'; this.style.borderColor='rgba(0,212,255,0.3)';">✍️ Đánh Giá</a>
                                @elseif($item->reviews()->where('user_id', auth()->id())->exists())
                                    <div style="margin-top: 8px; font-size: 12px; color: #86efac;">✓ Bạn đã đánh giá</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping Info -->
            <div style="background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)); border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; backdrop-filter: blur(20px); padding: 24px;">
                <h3 style="font-size: 16px; font-weight: 700; color: #f0f0f0; margin-bottom: 16px;">📍 Thông Tin Giao Hàng</h3>
                <div style="background: linear-gradient(135deg, rgba(0,212,255,0.1), rgba(0,212,255,0.05)); border-left: 3px solid #00d4ff; padding: 16px; border-radius: 8px;">
                    <p style="color: #b0b0c0; font-size: 14px; line-height: 1.8;">
                        <strong style="color: #f0f0f0;">{{ $order->shipping_address }}</strong><br>
                        {{ $order->shipping_district }}, {{ $order->shipping_city }}<br>
                        @if($order->notes) <br><strong style="color: #f0f0f0;">Ghi chú:</strong> {{ $order->notes }} @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Order Summary (Sticky) -->
        <div style="position: sticky; top: 100px; height: fit-content;">
            <div style="background: linear-gradient(135deg, rgba(0,212,255,0.15), rgba(139,92,246,0.1)); border: 1px solid rgba(0,212,255,0.3); border-radius: 14px; backdrop-filter: blur(20px); padding: 24px;">
                <h3 style="font-size: 16px; font-weight: 700; color: #f0f0f0; margin-bottom: 20px;">💰 Tóm Tắt Thanh Toán</h3>

                <div style="display: flex; justify-content: space-between; padding-bottom: 12px; margin-bottom: 12px; border-bottom: 1px solid rgba(0,212,255,0.2); color: #b0b0c0; font-size: 13px;">
                    <span>Tạm tính:</span>
                    <span>{{ number_format($order->subtotal, 0, ',', '.') }}đ</span>
                </div>

                <div style="display: flex; justify-content: space-between; padding-bottom: 12px; margin-bottom: 12px; border-bottom: 1px solid rgba(0,212,255,0.2); color: #b0b0c0; font-size: 13px;">
                    <span>Phí vận chuyển:</span>
                    <span>{{ number_format($order->shipping_fee, 0, ',', '.') }}đ</span>
                </div>

                @if($order->discount_amount > 0)
                    <div style="display: flex; justify-content: space-between; padding-bottom: 12px; margin-bottom: 12px; border-bottom: 1px solid rgba(0,212,255,0.2); color: #86efac; font-size: 13px;">
                        <span>Giảm giá:</span>
                        <span>-{{ number_format($order->discount_amount, 0, ',', '.') }}đ</span>
                    </div>
                @endif

                <div style="display: flex; justify-content: space-between; padding-top: 12px; background: linear-gradient(135deg, #00d4ff, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 16px; font-weight: 700;">
                    <span>Tổng:</span>
                    <span>{{ number_format($order->final_amount, 0, ',', '.') }}đ</span>
                </div>

                <!-- Status Badge -->
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(0,212,255,0.2);">
                    <div style="font-size: 12px; color: #808090; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Trạng Thái Thanh Toán</div>
                    @if($order->payment_status === 'paid')
                        <span style="background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(16,185,129,0.1)); color: #86efac; padding: 8px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">✓ Đã Thanh Toán</span>
                    @elseif($order->payment_status === 'pending')
                        <span style="background: linear-gradient(135deg, rgba(234,179,8,0.2), rgba(234,179,8,0.1)); color: #fde047; padding: 8px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">⏳ Chờ Xử Lý</span>
                    @else
                        <span style="background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(239,68,68,0.1)); color: #fca5a5; padding: 8px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">✗ Chưa Thanh Toán</span>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 20px;">
                    <a href="{{ route('order.list') }}" style="background: linear-gradient(135deg, rgba(0,212,255,0.15), rgba(0,212,255,0.08)); color: #00d4ff; border: 1px solid rgba(0,212,255,0.3); border-radius: 10px; padding: 10px 16px; text-align: center; text-decoration: none; font-weight: 600; font-size: 13px; transition: all 0.3s;" onmouseover="this.style.background='rgba(0,212,255,0.25)'; this.style.borderColor='rgba(0,212,255,0.5)';" onmouseout="this.style.background='rgba(0,212,255,0.15)'; this.style.borderColor='rgba(0,212,255,0.3)';">← Quay Lại Danh Sách</a>
                    <a href="{{ route('shop.index') }}" style="background: linear-gradient(135deg, #00d4ff, #8b5cf6); color: #080808; border: none; border-radius: 10px; padding: 10px 16px; text-align: center; text-decoration: none; font-weight: 600; font-size: 13px; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(0,212,255,0.4)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">🛍️ Tiếp Tục Mua Sắm</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                                </p>
                                <p style="color: #00f5ff; font-weight: 600; margin-top: 8px;">
                                    {{ number_format($item->subtotal, 0, ',', '.') }}đ
                                </p>

                                <!-- Review Button (if completed) -->
                                @if($order->order_status === 'completed' && !$item->reviews()->where('user_id', auth()->id())->exists())
                                    <a href="{{ route('review.create', $item->product->slug) }}" class="btn btn-secondary btn-small" style="display: inline-block; margin-top: 8px;">
                                        ✍️ Đánh Giá
                                    </a>
                                @elseif($item->reviews()->where('user_id', auth()->id())->exists())
                                    <div style="margin-top: 8px; font-size: 12px; color: #00f5ff;">
                                        ✓ Bạn đã đánh giá sản phẩm này
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="card fade-in" style="margin-bottom: 20px;">
                <h3 style="color: #00f5ff; margin-bottom: 15px; font-size: 18px;">📍 Thông Tin Giao Hàng</h3>

                <div style="background: rgba(0, 245, 255, 0.05); border-left: 3px solid #00f5ff; padding: 15px; border-radius: 4px;">
                    <div style="color: #ccc; line-height: 1.8;">
                        <strong style="color: #00f5ff;">Địa chỉ:</strong><br>
                        {{ $order->shipping_address }}<br>
                        {{ $order->shipping_district }}, {{ $order->shipping_city }}<br><br>

                        @if($order->notes)
                            <strong style="color: #00f5ff;">Ghi chú:</strong><br>
                            {{ $order->notes }}
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="card fade-in" style="background: rgba(0, 102, 255, 0.1); border: 1px solid rgba(0, 102, 255, 0.3);">
                <h3 style="color: #00f5ff; margin-bottom: 15px; font-size: 18px;">💰 Tóm Tắt Thanh Toán</h3>

                <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid rgba(0, 102, 255, 0.3); margin-bottom: 10px;">
                    <span style="color: #999;">Tạm tính:</span>
                    <span>{{ number_format($order->subtotal, 0, ',', '.') }}đ</span>
                </div>

                <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid rgba(0, 102, 255, 0.3); margin-bottom: 10px;">
                    <span style="color: #999;">Phí vận chuyển:</span>
                    <span>{{ number_format($order->shipping_fee, 0, ',', '.') }}đ</span>
                </div>

                @if($order->discount_amount > 0)
                    <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid rgba(0, 102, 255, 0.3); margin-bottom: 10px;">
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
    </div>

    <!-- Action Buttons -->
    <div style="display: flex; justify-content: center; gap: 15px; margin: 40px 0;">
        <a href="{{ route('order.list') }}" class="btn btn-secondary">
            ← Quay Lại Danh Sách
        </a>
        <a href="{{ route('shop.index') }}" class="btn btn-primary">
            🛍️ Tiếp Tục Mua Sắm
        </a>
    </div>
</div>
@endsection
