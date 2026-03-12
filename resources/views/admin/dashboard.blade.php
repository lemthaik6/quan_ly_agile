@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Tổng quan hệ thống quản lý')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Sản phẩm -->
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Tổng Sản Phẩm</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $totalProducts }}</h3>
                <p class="text-xs text-cyan-400 mt-2">
                    <i class="fas fa-check-circle"></i> {{ $activeProducts }} đang hoạt động
                </p>
            </div>
            <div class="text-4xl text-cyan-400/30">
                <i class="fas fa-box-open"></i>
            </div>
        </div>
    </div>

    <!-- Danh mục -->
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Danh Mục</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $totalCategories }}</h3>
                <p class="text-xs text-cyan-400 mt-2">Phân loại sản phẩm</p>
            </div>
            <div class="text-4xl text-purple-400/30">
                <i class="fas fa-folder"></i>
            </div>
        </div>
    </div>

    <!-- Đơn hàng -->
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Đơn Hàng</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $totalOrders }}</h3>
                <p class="text-xs text-yellow-400 mt-2">
                    <i class="fas fa-hourglass-half"></i> {{ $pendingOrders }} chờ xử lý
                </p>
            </div>
            <div class="text-4xl text-yellow-400/30">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <!-- Doanh thu -->
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Doanh Thu</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ number_format($totalRevenue, 0, ',', '.') }}đ</h3>
                <p class="text-xs text-green-400 mt-2">
                    <i class="fas fa-check-circle"></i> {{ $completedOrders }} đơn thành công
                </p>
            </div>
            <div class="text-4xl text-green-400/30">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>
</div>

<!-- Hàng thứ 2 -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Khách hàng -->
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Khách Hàng</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $totalCustomers }}</h3>
                <p class="text-xs text-cyan-400 mt-2">
                    <i class="fas fa-user-plus"></i> {{ $newCustomersThisMonth }} khách mới tháng này
                </p>
            </div>
            <div class="text-4xl text-cyan-400/30">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <!-- Đơn hàng hoàn thành -->
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Đơn Hoàn Thành</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $completedOrders }}</h3>
                <p class="text-xs text-green-400 mt-2">
                    Tỷ lệ thành công: {{ $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100, 1) : 0 }}%
                </p>
            </div>
            <div class="text-4xl text-green-400/30">
                <i class="fas fa-check-double"></i>
            </div>
        </div>
    </div>

    <!-- Tồn kho -->
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Tồn Kho</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ 
                    \App\Models\Product::sum('quantity_in_stock') 
                }}</h3>
                <p class="text-xs text-orange-400 mt-2">Đơn vị sản phẩm</p>
            </div>
            <div class="text-4xl text-orange-400/30">
                <i class="fas fa-warehouse"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Đơn hàng gần đây -->
    <div class="lg:col-span-2">
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-orbitron font-bold text-white">Đơn Hàng Gần Đây</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-cyan-400 hover:text-cyan-300 text-sm">Xem tất cả →</a>
            </div>

            @if($recentOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã ĐH</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td class="font-semibold">#{{ $order->order_number }}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ number_format($order->final_amount, 0, ',', '.') }}đ</td>
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
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm">Chi tiết</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-400 text-center py-8">Chưa có đơn hàng nào</p>
            @endif
        </div>
    </div>

    <!-- Sản phẩm bán chạy -->
    <div>
        <div class="card">
            <h2 class="text-lg font-orbitron font-bold text-white mb-6">Sản Phẩm Bán Chạy</h2>

            @if($topProducts->count() > 0)
                <div class="space-y-4">
                    @foreach($topProducts as $index => $product)
                    <div class="p-3 rounded-lg bg-cyan-400/5 border border-cyan-400/10">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-lg font-bold text-cyan-400">{{ $index + 1 }}</span>
                                <span class="text-sm font-semibold text-white truncate">{{ $product->name }}</span>
                            </div>
                            <span class="text-green-400 font-bold">{{ $product->sold_count }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-400">
                            <span>{{ number_format($product->price, 0, ',', '.') }}đ</span>
                            <span>Tồn: {{ $product->quantity_in_stock }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-8">Chưa có sản phẩm bán chạy</p>
            @endif
        </div>
    </div>
</div>
@endsection
