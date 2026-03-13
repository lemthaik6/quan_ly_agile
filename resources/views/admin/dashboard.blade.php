@extends('layouts.admin')

@section('title', 'Dashboard | Admin Panel')

@section('content')
<div class="bg-slate-900 min-h-screen pt-8">
    <!-- Page Header -->
    <div class="mb-10 px-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-400 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                    Dashboard
                </h1>
                <p class="text-slate-400 mt-2">Chào mừng trở lại, {{ auth()->user()->name }} 👋</p>
            </div>
            <div class="text-right">
                <p class="text-slate-400">{{ now()->format('l, F j, Y') }}</p>
                <p class="text-2xl font-bold text-white mt-1">{{ now()->format('H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="px-8 pb-12">
        <!-- Top Stats Row - Gợn Xóng Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Revenue Card -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-cyan-500/20 p-6 hover:border-cyan-400/50 transition-all duration-300 hover:shadow-2xl hover:shadow-cyan-500/20">
                <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/10 group-hover:to-cyan-500/5 transition-all duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-slate-400 text-sm font-medium">Doanh Thu Total</h3>
                        <div class="bg-cyan-500/20 p-3 rounded-lg group-hover:bg-cyan-500/30 transition-colors">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-transparent bg-gradient-to-r from-cyan-300 to-cyan-500 bg-clip-text">
                        {{ number_format($totalRevenue, 0, ',', '.') }} ₫
                    </p>
                    <p class="text-cyan-400 text-xs mt-2">Hôm nay: <strong>{{ number_format($todayRevenue, 0, ',', '.') }} ₫</strong></p>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-purple-500/20 p-6 hover:border-purple-400/50 transition-all duration-300 hover:shadow-2xl hover:shadow-purple-500/20">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/0 to-purple-500/0 group-hover:from-purple-500/10 group-hover:to-purple-500/5 transition-all duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-slate-400 text-sm font-medium">Tổng Đơn Hàng</h3>
                        <div class="bg-purple-500/20 p-3 rounded-lg group-hover:bg-purple-500/30 transition-colors">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-transparent bg-gradient-to-r from-purple-300 to-purple-500 bg-clip-text">
                        {{ $totalOrders }}
                    </p>
                    <p class="text-purple-400 text-xs mt-2">Hôm nay: <strong>{{ $todayOrders }}</strong> | Chờ: <strong>{{ $pendingOrders }}</strong></p>
                </div>
            </div>

            <!-- Customers Card -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-pink-500/20 p-6 hover:border-pink-400/50 transition-all duration-300 hover:shadow-2xl hover:shadow-pink-500/20">
                <div class="absolute inset-0 bg-gradient-to-br from-pink-500/0 to-pink-500/0 group-hover:from-pink-500/10 group-hover:to-pink-500/5 transition-all duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-slate-400 text-sm font-medium">Khách Hàng</h3>
                        <div class="bg-pink-500/20 p-3 rounded-lg group-hover:bg-pink-500/30 transition-colors">
                            <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zM5 20H0v-2a6 6 0 016-6v0a6 6 0 016 6v2H5z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-transparent bg-gradient-to-r from-pink-300 to-pink-500 bg-clip-text">
                        {{ $totalCustomers }}
                    </p>
                    <p class="text-pink-400 text-xs mt-2">Mới: <strong>{{ $newCustomers }}</strong> (7 ngày) | Tháng: <strong>{{ $newCustomersThisMonth }}</strong></p>
                </div>
            </div>

            <!-- Products Card -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-orange-500/20 p-6 hover:border-orange-400/50 transition-all duration-300 hover:shadow-2xl hover:shadow-orange-500/20">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-500/0 to-orange-500/0 group-hover:from-orange-500/10 group-hover:to-orange-500/5 transition-all duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-slate-400 text-sm font-medium">Sản Phẩm</h3>
                        <div class="bg-orange-500/20 p-3 rounded-lg group-hover:bg-orange-500/30 transition-colors">
                            <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4v10M8 7l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-transparent bg-gradient-to-r from-orange-300 to-orange-500 bg-clip-text">
                        {{ $totalProducts }}
                    </p>
                    <p class="text-orange-400 text-xs mt-2">Active: <strong>{{ $activeProducts }}</strong> | Category: <strong>{{ $totalCategories }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
            <!-- Revenue Chart -->
            <div class="lg:col-span-2 backdrop-blur-xl bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6 hover:border-slate-600/50 transition-all duration-300">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <span class="w-1 h-6 bg-gradient-to-b from-cyan-400 to-purple-500 rounded-full"></span>
                        Doanh Thu Hàng Tháng
                    </h3>
                    <span class="text-xs text-slate-400 bg-slate-700/50 px-3 py-1 rounded-full">Năm {{ now()->year }}</span>
                </div>
                <div class="relative h-80">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Order Status Chart -->
            <div class="backdrop-blur-xl bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6 hover:border-slate-600/50 transition-all duration-300">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <span class="w-1 h-6 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full"></span>
                        Trạng Thái Đơn Hàng
                    </h3>
                </div>
                <div class="relative h-80">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Second Row Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
            <!-- Top Products -->
            <div class="backdrop-blur-xl bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6 hover:border-slate-600/50 transition-all duration-300">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <span class="w-1 h-6 bg-gradient-to-b from-pink-400 to-orange-500 rounded-full"></span>
                        Sản Phẩm Bán Chạy
                    </h3>
                </div>
                <div class="relative h-80">
                    <canvas id="productsChart"></canvas>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="backdrop-blur-xl bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6 hover:border-slate-600/50 transition-all duration-300">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <span class="w-1 h-6 bg-gradient-to-b from-orange-400 to-red-500 rounded-full"></span>
                        Đơn Hàng Gần Đây
                    </h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs text-cyan-400 hover:text-cyan-300 transition">Xem tất cả →</a>
                </div>
                <div class="space-y-3 max-h-80 overflow-y-auto">
                    @forelse($recentOrders as $order)
                        <div class="flex items-center justify-between p-3 bg-slate-700/30 rounded-lg hover:bg-slate-700/50 transition-colors border border-slate-600/30">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-white">{{ $order->order_code }}</p>
                                <p class="text-xs text-slate-400">{{ $order->user->name ?? 'Unknown' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-transparent bg-gradient-to-r from-cyan-300 to-purple-400 bg-clip-text">
                                    {{ number_format($order->final_amount, 0, ',', '.') }} ₫
                                </p>
                                <span class="inline-block text-xs px-2 py-1 rounded-full bg-blue-500/20 text-blue-300 mt-1">
                                    {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-400 py-8">Chưa có đơn hàng</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Bottom Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Selling Products -->
            <div class="backdrop-blur-xl bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6 hover:border-slate-600/50 transition-all duration-300">
                <h3 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-6 bg-gradient-to-b from-cyan-400 to-purple-500 rounded-full"></span>
                    Top 5 Sản Phẩm
                </h3>
                <div class="space-y-3">
                    @forelse($topSellingProducts as $index => $product)
                        <div class="flex items-center gap-4 group">
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-cyan-500 to-purple-600 text-white font-bold text-sm group-hover:shadow-lg group-hover:shadow-cyan-500/50 transition-all">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-white truncate group-hover:text-cyan-300 transition">{{ $product->name }}</p>
                                <p class="text-xs text-slate-400">{{ number_format($product->sold_count) }} bán, {{ number_format($product->price, 0, ',', '.') }} ₫</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-400 py-6">Chưa có sản phẩm</p>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="backdrop-blur-xl bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6 hover:border-slate-600/50 transition-all duration-300">
                <h3 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-6 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full"></span>
                    Hành Động Nhanh
                </h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.products.create') }}" class="group flex items-center justify-between p-4 bg-slate-700/30 hover:bg-gradient-to-r hover:from-cyan-500/20 hover:to-cyan-400/10 rounded-lg transition-all border border-slate-600/30 hover:border-cyan-500/50">
                        <span class="text-sm font-medium text-white">Thêm Sản Phẩm</span>
                        <svg class="w-5 h-5 text-cyan-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="group flex items-center justify-between p-4 bg-slate-700/30 hover:bg-gradient-to-r hover:from-purple-500/20 hover:to-purple-400/10 rounded-lg transition-all border border-slate-600/30 hover:border-purple-500/50">
                        <span class="text-sm font-medium text-white">Quản Lý Sản Phẩm</span>
                        <svg class="w-5 h-5 text-purple-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="group flex items-center justify-between p-4 bg-slate-700/30 hover:bg-gradient-to-r hover:from-pink-500/20 hover:to-pink-400/10 rounded-lg transition-all border border-slate-600/30 hover:border-pink-500/50">
                        <span class="text-sm font-medium text-white">Đơn Hàng</span>
                        <svg class="w-5 h-5 text-pink-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="group flex items-center justify-between p-4 bg-slate-700/30 hover:bg-gradient-to-r hover:from-orange-500/20 hover:to-orange-400/10 rounded-lg transition-all border border-slate-600/30 hover:border-orange-500/50">
                        <span class="text-sm font-medium text-white">Danh Mục</span>
                        <svg class="w-5 h-5 text-orange-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: @json($monthlyRevenue->pluck('month')),
            datasets: [{
                label: 'Doanh Thu (₫)',
                data: @json($monthlyRevenue->pluck('revenue')),
                borderColor: 'rgb(34, 211, 238)',
                backgroundColor: 'rgba(34, 211, 238, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: 'rgba(34, 211, 238, 1)',
                pointBorderColor: 'rgba(15, 23, 42, 1)',
                pointBorderWidth: 2,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: { color: 'rgb(148, 163, 184)', font: { size: 12, weight: 500 } }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: 'rgb(148, 163, 184)' },
                    grid: { color: 'rgba(71, 85, 105, 0.2)', drawBorder: false }
                },
                x: {
                    ticks: { color: 'rgb(148, 163, 184)' },
                    grid: { display: false, drawBorder: false }
                }
            }
        }
    });

    // Order Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Chờ', 'Đang Xử Lý', 'Đang Giao', 'Đã Giao', 'Đã Hủy'],
            datasets: [{
                data: [
                    {{ $orderStatusDistribution['dang_cho'] }},
                    {{ $orderStatusDistribution['dang_xu_ly'] }},
                    {{ $orderStatusDistribution['dang_giao'] }},
                    {{ $orderStatusDistribution['da_giao'] }},
                    {{ $orderStatusDistribution['da_huy'] }}
                ],
                backgroundColor: [
                    'rgba(244, 114, 182, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: 'rgba(15, 23, 42, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: 'rgb(148, 163, 184)', font: { size: 11, weight: 500 }, padding: 15 }
                }
            }
        }
    });

    // Products Chart
    const productsCtx = document.getElementById('productsChart').getContext('2d');
    new Chart(productsCtx, {
        type: 'bar',
        data: {
            labels: @json($topSellingProducts->pluck('name')),
            datasets: [{
                label: 'Số Lượng Bán',
                data: @json($topSellingProducts->pluck('sold_count')),
                backgroundColor: [
                    'rgba(34, 211, 238, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(236, 72, 153, 0.8)',
                    'rgba(249, 115, 22, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ],
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: { color: 'rgb(148, 163, 184)', font: { size: 12, weight: 500 } }
                }
            },
            scales: {
                x: {
                    ticks: { color: 'rgb(148, 163, 184)' },
                    grid: { color: 'rgba(71, 85, 105, 0.2)', drawBorder: false }
                },
                y: {
                    ticks: { color: 'rgb(148, 163, 184)' },
                    grid: { display: false, drawBorder: false }
                }
            }
        }
    });
</script>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
</style>
@endsection
