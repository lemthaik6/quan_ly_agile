@extends('layouts.admin')

@section('title', 'Báo cáo thống kê')
@section('page-title', 'Báo Cáo & Thống Kê')
@section('page-subtitle', 'Phân tích doanh số, khách hàng và sản phẩm')

@section('content')
<!-- Bộ lọc -->
<div class="card mb-6">
    <form method="GET" action="{{ route('admin.reports.index') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-sm text-gray-400 block mb-2">Từ Ngày</label>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}"
                       class="w-full bg-cyan-400/5 border border-cyan-400/20 rounded-lg px-4 py-2 text-white">
            </div>
            <div>
                <label class="text-sm text-gray-400 block mb-2">Đến Ngày</label>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}"
                       class="w-full bg-cyan-400/5 border border-cyan-400/20 rounded-lg px-4 py-2 text-white">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 btn-primary">
                    <i class="fas fa-filter mr-2"></i> Lọc
                </button>
                <a href="{{ route('admin.reports.index') }}" class="btn-secondary">
                    <i class="fas fa-redo mr-2"></i>
                </a>
                <a href="{{ route('admin.reports.export', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}" class="btn-secondary">
                    <i class="fas fa-download mr-2"></i>
                </a>
            </div>
        </div>
    </form>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Doanh Thu</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($revenue, 0, ',', '.') }}đ</h3>
                <p class="text-xs text-green-400 mt-2">
                    <i class="fas fa-check-circle"></i> {{ $revenueOrders }} đơn thành công
                </p>
            </div>
            <div class="text-4xl text-green-400/30">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Tổng Đơn Hàng</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalOrders }}</h3>
                <p class="text-xs text-red-400 mt-2">
                    <i class="fas fa-times-circle"></i> {{ $canceledOrders }} hủy
                </p>
            </div>
            <div class="text-4xl text-yellow-400/30">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Khách Hàng Mới</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $newCustomers }}</h3>
                <p class="text-xs text-cyan-400 mt-2">
                    Trong khoảng thời gian
                </p>
            </div>
            <div class="text-4xl text-cyan-400/30">
                <i class="fas fa-user-plus"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Giá Trị Trung Bình</p>
                <h3 class="text-3xl font-bold text-white mt-2">
                    {{ $revenueOrders > 0 ? number_format($revenue / $revenueOrders, 0, ',', '.') : 0 }}đ
                </h3>
                <p class="text-xs text-purple-400 mt-2">Trên mỗi đơn</p>
            </div>
            <div class="text-4xl text-purple-400/30">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Trạng thái đơn hàng -->
    <div class="card">
        <h2 class="text-lg font-orbitron font-bold text-gray-900 mb-6">Trạng Thái Đơn Hàng</h2>
        <div class="space-y-4">
            @foreach($ordersByStatus as $status)
                @php
                    $statusNames = [
                        'dang_cho' => 'Đang chờ',
                        'da_xac_nhan' => 'Đã xác nhận',
                        'dang_xu_ly' => 'Đang xử lý',
                        'da_gui' => 'Đã gửi',
                        'da_giao' => 'Đã giao',
                        'da_huy' => 'Đã hủy'
                    ];
                    $statusColors = [
                        'dang_cho' => 'bg-yellow-400',
                        'da_xac_nhan' => 'bg-blue-400',
                        'dang_xu_ly' => 'bg-blue-400',
                        'da_gui' => 'bg-blue-400',
                        'da_giao' => 'bg-green-400',
                        'da_huy' => 'bg-red-400'
                    ];
                    $percent = $totalOrders > 0 ? ($status->count / $totalOrders) * 100 : 0;
                @endphp
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-900 font-semibold">{{ $statusNames[$status->order_status] ?? 'N/A' }}</span>
                        <span class="text-gray-400">{{ $status->count }} ({{ round($percent) }}%)</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="{{ $statusColors[$status->order_status] ?? 'bg-gray-400' }} h-2 rounded-full" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Phương thức thanh toán -->
    <div class="card">
        <h2 class="text-lg font-orbitron font-bold text-gray-900 mb-6">Phương Thức Thanh Toán</h2>
        <div class="space-y-4">
            @foreach($paymentMethods as $payment)
                @php
                    $paymentNames = [
                        'cod' => '💵 Tiền mặt (COD)',
                        'chuyen_khoan' => '🏦 Chuyển khoản',
                        'the_tin_dung' => '💳 Thẻ tín dụng',
                        'vi_dien_tu' => '📱 Ví điện tử'
                    ];
                    $percent = $revenueOrders > 0 ? ($payment->count / $revenueOrders) * 100 : 0;
                @endphp
                <div class="p-3 rounded-lg bg-cyan-400/5 border border-cyan-400/10">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-900 font-semibold">{{ $paymentNames[$payment->payment_method] ?? $payment->payment_method }}</span>
                        <span class="text-green-400 font-bold">{{ number_format($payment->total, 0, ',', '.') }}đ</span>
                    </div>
                    <div class="text-xs text-gray-400">{{ $payment->count }} đơn ({{ round($percent) }}%)</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Sản phẩm bán chạy -->
<div class="card mb-6">
    <h2 class="text-lg font-orbitron font-bold text-gray-900 mb-6">Sản Phẩm Bán Chạy Nhất</h2>
    
    @if($topProducts->count() > 0)
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Sản Phẩm</th>
                        <th class="text-right">Số Lượng Bán</th>
                        <th class="text-right">Doanh Thu</th>
                        <th class="text-right">% Doanh Thu</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalRevenue = $topProducts->sum('revenue');
                    @endphp
                    @foreach($topProducts as $product)
                        @php
                            $percent = $totalRevenue > 0 ? ($product->revenue / $totalRevenue) * 100 : 0;
                        @endphp
                        <tr>
                            <td class="font-semibold">{{ $product->name }}</td>
                            <td class="text-right">{{ $product->total_sold }}</td>
                            <td class="text-right text-green-400 font-bold">{{ number_format($product->revenue, 0, ',', '.') }}đ</td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <div class="w-20 bg-gray-700 rounded-full h-2">
                                        <div class="bg-cyan-400 h-2 rounded-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-400 min-w-max">{{ round($percent) }}%</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-400 text-center py-8">Không có dữ liệu</p>
    @endif
</div>

<!-- Doanh thu theo ngày -->
<div class="card">
    <h2 class="text-lg font-orbitron font-bold text-gray-900 mb-6">Doanh Thu Theo Ngày</h2>
    
    @if($dailyRevenue->count() > 0)
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Ngày</th>
                        <th class="text-right">Số Đơn</th>
                        <th class="text-right">Doanh Thu</th>
                        <th class="text-right">Trung Bình</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyRevenue as $day)
                        <tr>
                            <td class="font-semibold">{{ \Carbon\Carbon::parse($day->date)->format('d/m/Y') }}</td>
                            <td class="text-right">{{ $day->orders }}</td>
                            <td class="text-right text-green-400 font-bold">{{ number_format($day->revenue, 0, ',', '.') }}đ</td>
                            <td class="text-right text-cyan-400">{{ number_format($day->revenue / $day->orders, 0, ',', '.') }}đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-400 text-center py-8">Không có dữ liệu</p>
    @endif
</div>
@endsection
