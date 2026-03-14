@extends('layouts.admin')

@section('title', 'Chi Tiết Đơn Hàng')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Đơn hàng #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Quay lại</a>
    </div>

    <!-- Order Info & Status -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Details -->
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Thông Tin Đơn Hàng</h2>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-gray-600 text-sm">Khách hàng</p>
                    <p class="font-semibold">{{ $order->user->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Email</p>
                    <p class="font-semibold">{{ $order->user->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Điện thoại</p>
                    <p class="font-semibold">{{ $order->user->phone ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Ngày tạo</p>
                    <p class="font-semibold">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <h3 class="text-lg font-semibold mb-4">Địa Chỉ Giao Hàng</h3>
            <div class="bg-gray-50 p-4 rounded mb-6">
                <p>{{ $order->shipping_address ?? 'Không có' }}</p>
                <p class="text-sm text-gray-600 mt-2">{{ $order->shipping_city ?? '' }} - {{ $order->shipping_zip ?? '' }}</p>
            </div>

            <!-- Order Items -->
            <h3 class="text-lg font-semibold mb-4">Chi Tiết Sản Phẩm</h3>
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Sản phẩm</th>
                        <th class="px-4 py-2 text-left">Đơn giá</th>
                        <th class="px-4 py-2 text-left">Số lượng</th>
                        <th class="px-4 py-2 text-left">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->items as $item)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
                            <td class="px-4 py-2">{{ number_format($item->price, 0, ',', '.') }} ₫</td>
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <td class="px-4 py-2">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} ₫</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Không có sản phẩm</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Order Summary -->
        <div class="bg-white p-6 rounded-lg shadow h-fit">
            <h2 class="text-lg font-semibold mb-4">Tóm Tắt Đơn Hàng</h2>
            
            <div class="space-y-2 mb-4">
                <div class="flex justify-between">
                    <span>Tổng sản phẩm</span>
                    <span class="font-semibold">{{ number_format($order->items->sum('quantity'), 0) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span class="font-semibold">{{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.') }} ₫</span>
                </div>
                <div class="flex justify-between">
                    <span>Phí vận chuyển</span>
                    <span class="font-semibold">{{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }} ₫</span>
                </div>
                <div class="border-t pt-2 flex justify-between text-lg font-bold">
                    <span>Tổng cộng</span>
                    <span class="text-blue-600">{{ number_format($order->total_price, 0, ',', '.') }} ₫</span>
                </div>
            </div>

            <hr class="my-4">

            <div class="mb-4">
                <p class="text-gray-600 text-sm mb-2">Trạng thái đơn hàng</p>
                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                    {{ $order->order_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $order->order_status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                    {{ $order->order_status === 'shipped' ? 'bg-indigo-100 text-indigo-800' : '' }}
                    {{ $order->order_status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $order->order_status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                ">
                    {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                </span>
            </div>

            <!-- Status Update Form -->
            <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="space-y-2">
                @csrf
                @method('PUT')
                
                <select name="order_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                    <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="shipped" {{ $order->order_status === 'shipped' ? 'selected' : '' }}>Đã gửi</option>
                    <option value="delivered" {{ $order->order_status === 'delivered' ? 'selected' : '' }}>Đã giao</option>
                    <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                </select>
                
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Cập nhật trạng thái</button>
            </form>
        </div>
    </div>

    <!-- Order Tracking -->
    @if($order->tracking)
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Theo Dõi Vận Chuyển</h2>
            <div class="space-y-2">
                <p><strong>Đơn vị vận chuyển:</strong> {{ $order->tracking->carrier ?? 'N/A' }}</p>
                <p><strong>Mã tracking:</strong> {{ $order->tracking->tracking_number ?? 'N/A' }}</p>
                <p><strong>Trạng thái:</strong> {{ $order->tracking->status ?? 'N/A' }}</p>
            </div>
        </div>
    @endif
</div>
@endsection
