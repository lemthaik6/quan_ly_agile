@extends('layouts.admin')

@section('title', 'Báo Cáo & Thống Kê')

@section('content')
<div class="space-y-6">
    <h1 class="text-3xl font-bold">Báo Cáo & Thống Kê</h1>
    
    <!-- Date Filter -->
    <div class="bg-white p-4 rounded-lg shadow">
        <form method="GET" class="flex gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Từ ngày</label>
                <input type="date" name="start_date" value="{{ request('start_date', $startDate->format('Y-m-d')) }}" class="px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Đến ngày</label>
                <input type="date" name="end_date" value="{{ request('end_date', $endDate->format('Y-m-d')) }}" class="px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Lọc</button>
                <a href="{{ route('admin.reports.export', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Tải xuống</a>
            </div>
        </form>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-600 text-sm font-semibold">Doanh Thu</h3>
            <p class="text-3xl font-bold text-blue-600">{{ number_format($revenue, 0, ',', '.') }} ₫</p>
            <p class="text-sm text-gray-500">Từ {{ $revenueOrders }} đơn hàng</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-600 text-sm font-semibold">Tổng Đơn Hàng</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalOrders }}</p>
            <p class="text-sm text-gray-500">Đơn đã hủy: {{ $canceledOrders }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-600 text-sm font-semibold">Khách Hàng Mới</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $newCustomers }}</p>
            <p class="text-sm text-gray-500">Người dùng mới</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-600 text-sm font-semibold">Tỷ Lệ Chuyển Đổi</h3>
            <p class="text-3xl font-bold text-orange-600">{{ $totalOrders > 0 ? round(($totalOrders / 1000) * 100, 1) : 0 }}%</p>
            <p class="text-sm text-gray-500">Tỷ lệ ghi danh</p>
        </div>
    </div>

    <!-- Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Products -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Sản Phẩm Bán Chạy</h2>
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Sản phẩm</th>
                        <th class="px-4 py-2 text-left">Số lượng</th>
                        <th class="px-4 py-2 text-left">Doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topProducts as $product)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ $product->total_sold }}</td>
                            <td class="px-4 py-2">{{ number_format($product->revenue, 0, ',', '.') }} ₫</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Order Status -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Trạng Thái Đơn Hàng</h2>
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Trạng thái</th>
                        <th class="px-4 py-2 text-left">Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ordersByStatus as $status)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ ucfirst(str_replace('_', ' ', $status->order_status)) }}</td>
                            <td class="px-4 py-2">{{ $status->count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-4 py-2 text-center text-gray-500">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Daily Revenue Table -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Doanh Thu Hàng Ngày</h2>
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Ngày</th>
                    <th class="px-4 py-2 text-left">Số đơn</th>
                    <th class="px-4 py-2 text-left">Doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dailyRevenue as $day)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($day->date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ $day->orders }}</td>
                        <td class="px-4 py-2">{{ number_format($day->revenue, 0, ',', '.') }} ₫</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-center text-gray-500">Không có dữ liệu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
