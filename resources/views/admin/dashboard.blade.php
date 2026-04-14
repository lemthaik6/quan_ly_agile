@extends('layouts.admin')

@section('title', 'Dashboard | Command Center')
@section('page-title', 'Command Center')
@section('page-subtitle', 'Real-time insights & control')

@section('content')
<div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">

    <!-- KPI Cards - Premium Multi-level -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--sp-xl);">
        
        <!-- Revenue Card -->
        <div class="panel-elevated" style="padding: var(--sp-xl); cursor: pointer; transition: all 0.3s; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; background: radial-gradient(circle, rgba(0,212,255,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
            <div style="position: relative; z-index: 2;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-lg);">
                    <div>
                        <p style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; margin-bottom: var(--sp-sm);">Doanh Thu</p>
                        <h3 style="font-size: 28px; font-weight: 700; color: var(--laser-blue); margin: 0; font-family: var(--font-display); letter-spacing: -0.5px;">{{ number_format($totalRevenue, 0, ',', '.') }} ₫</h3>
                    </div>
                    <div style="width: 48px; height: 48px; border-radius: var(--radius-lg); background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(0,212,255,0.1)); display: flex; align-items: center; justify-content: center; color: var(--laser-blue); font-size: 24px;">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
                <p style="font-size: 12px; color: var(--text-secondary); margin: 0;">Hôm nay: <span style="color: var(--laser-blue); font-weight: 600;">{{ number_format($todayRevenue, 0, ',', '.') }} ₫</span></p>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="panel-elevated" style="padding: var(--sp-xl); cursor: pointer; transition: all 0.3s; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; background: radial-gradient(circle, rgba(139,92,246,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
            <div style="position: relative; z-index: 2;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-lg);">
                    <div>
                        <p style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; margin-bottom: var(--sp-sm);">Đơn Hàng</p>
                        <h3 style="font-size: 28px; font-weight: 700; color: var(--electric-violet); margin: 0; font-family: var(--font-display); letter-spacing: -0.5px;">{{ $totalOrders }}</h3>
                    </div>
                    <div style="width: 48px; height: 48px; border-radius: var(--radius-lg); background: linear-gradient(135deg, rgba(139,92,246,0.2), rgba(139,92,246,0.1)); display: flex; align-items: center; justify-content: center; color: var(--electric-violet); font-size: 24px;">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
                <p style="font-size: 12px; color: var(--text-secondary); margin: 0;">Hôm nay: <span style="color: var(--electric-violet); font-weight: 600;">{{ $todayOrders }}</span> | Chờ: <span style="color: var(--warning);">{{ $pendingOrders }}</span></p>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="panel-elevated" style="padding: var(--sp-xl); cursor: pointer; transition: all 0.3s; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; background: radial-gradient(circle, rgba(16,185,129,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
            <div style="position: relative; z-index: 2;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-lg);">
                    <div>
                        <p style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; margin-bottom: var(--sp-sm);">Khách Hàng</p>
                        <h3 style="font-size: 28px; font-weight: 700; color: var(--success); margin: 0; font-family: var(--font-display); letter-spacing: -0.5px;">{{ $totalCustomers }}</h3>
                    </div>
                    <div style="width: 48px; height: 48px; border-radius: var(--radius-lg); background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(16,185,129,0.1)); display: flex; align-items: center; justify-content: center; color: var(--success); font-size: 24px;">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <p style="font-size: 12px; color: var(--text-secondary); margin: 0;">Mới (7d): <span style="color: var(--success); font-weight: 600;">{{ $newCustomers }}</span> | Tháng: <span style="font-weight: 600;">{{ $newCustomersThisMonth }}</span></p>
            </div>
        </div>

        <!-- Products Card -->
        <div class="panel-elevated" style="padding: var(--sp-xl); cursor: pointer; transition: all 0.3s; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; background: radial-gradient(circle, rgba(245,158,11,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
            <div style="position: relative; z-index: 2;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-lg);">
                    <div>
                        <p style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; margin-bottom: var(--sp-sm);">Sản Phẩm</p>
                        <h3 style="font-size: 28px; font-weight: 700; color: var(--warning); margin: 0; font-family: var(--font-display); letter-spacing: -0.5px;">{{ $totalProducts }}</h3>
                    </div>
                    <div style="width: 48px; height: 48px; border-radius: var(--radius-lg); background: linear-gradient(135deg, rgba(245,158,11,0.2), rgba(245,158,11,0.1)); display: flex; align-items: center; justify-content: center; color: var(--warning); font-size: 24px;">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <p style="font-size: 12px; color: var(--text-secondary); margin: 0;">Active: <span style="color: var(--success); font-weight: 600;">{{ $activeProducts }}</span> | Danh mục: {{ $totalCategories }}</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: var(--sp-xl);">
        
        <!-- Revenue Chart -->
        <div class="panel" style="padding: var(--sp-xl);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--sp-xl);">
                <div>
                    <h3 style="margin: 0 0 4px 0; font-size: 16px; font-weight: 600;">Doanh Thu Tháng</h3>
                    <p style="margin: 0; font-size: 12px; color: var(--text-muted);">Năm {{ now()->year }}</p>
                </div>
                <span style="font-size: 12px; padding: 6px 12px; background: rgba(0,212,255,0.1); border: 1px solid rgba(0,212,255,0.2); border-radius: 12px; color: var(--laser-blue);">Tổng: 12M</span>
            </div>
            <canvas id="revenueChart" style="max-height: 280px;"></canvas>
        </div>

        <!-- Order Status Chart -->
        <div class="panel" style="padding: var(--sp-xl);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--sp-xl);">
                <div>
                    <h3 style="margin: 0 0 4px 0; font-size: 16px; font-weight: 600;">Trạng Thái Đơn Hàng</h3>
                    <p style="margin: 0; font-size: 12px; color: var(--text-muted);">Phân bố theo status</p>
                </div>
            </div>
            <canvas id="statusChart" style="max-height: 280px;"></canvas>
        </div>
    </div>

    <!-- Data Tables Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: var(--sp-xl);">
        
        <!-- Recent Orders -->
        <div class="panel" style="padding: var(--sp-xl); display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--sp-xl);">
                <h3 style="margin: 0; font-size: 16px; font-weight: 600;">Đơn Hàng Gần Đây</h3>
                <a href="{{ route('admin.orders.index') }}" style="font-size: 12px; color: var(--laser-blue); text-decoration: none; transition: color 0.3s;">Xem tất cả →</a>
            </div>
            <div style="flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: var(--sp-md);">
                @forelse($recentOrders as $order)
                    <div style="padding: var(--sp-lg); background: linear-gradient(90deg, rgba(0,212,255,0.05), transparent); border-radius: var(--radius-md); border: var(--border-thin); transition: all 0.3s; cursor: pointer;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-sm);">
                            <div>
                                <p style="margin: 0; font-size: 14px; font-weight: 600; color: var(--text-primary);">{{ $order->order_number ?? $order->order_code ?? '#' . $order->id }}</p>
                                <p style="margin: 2px 0 0 0; font-size: 12px; color: var(--text-muted);">
                                    {{ $order->user->name ?? 'Khách ẩn danh' }}
                                    @php
                                        $productNames = $order->orderItems->pluck('product.name')->filter()->unique()->take(2);
                                    @endphp
                                    @if($productNames->isNotEmpty())
                                        · {{ $productNames->implode(', ') }}{{ $order->orderItems->count() > 2 ? '...' : '' }}
                                    @endif
                                </p>
                            </div>
                            <div style="text-align: right;">
                                <p style="margin: 0; font-size: 14px; font-weight: 600; color: var(--laser-blue);">{{ number_format($order->final_amount, 0, ',', '.') }}₫</p>
                                <span class="badge badge-{{ $order->order_status === 'da_giao' ? 'success' : ($order->order_status === 'da_huy' ? 'error' : 'info') }}" style="margin-top: 4px;">
                                    {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="margin: var(--sp-2xl) 0; text-align: center; color: var(--text-muted); font-size: 14px;">Chưa có đơn hàng</p>
                @endforelse
            </div>
        </div>

        <!-- Top Products -->
        <div class="panel" style="padding: var(--sp-xl); display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--sp-xl);">
                <h3 style="margin: 0; font-size: 16px; font-weight: 600;">Sản Phẩm Bán Chạy (Quần Áo)</h3>
                <a href="{{ route('admin.products.index') }}" style="font-size: 12px; color: var(--laser-blue); text-decoration: none; transition: color 0.3s;">Top 10 →</a>
            </div>
            <div style="flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: var(--sp-md);">
                @forelse($topSellingProducts as $index => $product)
                    <div style="display: flex; align-items: center; gap: var(--sp-lg);">
                        <div style="width: 32px; height: 32px; border-radius: var(--radius-md); background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet)); display: flex; align-items: center; justify-content: center; color: var(--obsidian); font-weight: 600; font-size: 12px; flex-shrink: 0;">{{ $index + 1 }}</div>
                        <div style="flex: 1; min-width: 0;">
                            <p style="margin: 0; font-size: 13px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->name }}</p>
                            <p style="margin: 2px 0 0 0; font-size: 11px; color: var(--text-muted);">{{ number_format($product->sold_count ?? 0) }} bán</p>
                        </div>
                        <div style="text-align: right; flex-shrink: 0;">
                            <p style="margin: 0; font-size: 13px; font-weight: 600; color: var(--laser-blue);">{{ number_format($product->price, 0, ',', '.') }}₫</p>
                        </div>
                    </div>
                @empty
                    <p style="margin: var(--sp-2xl) 0; text-align: center; color: var(--text-muted); font-size: 14px;">Chưa có dữ liệu</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="panel" style="padding: var(--sp-xl);">
        <h3 style="margin: 0 0 var(--sp-xl) 0; font-size: 16px; font-weight: 600;">Hành Động Nhanh</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--sp-lg);">
            <a href="{{ route('admin.products.create') }}" style="padding: var(--sp-lg); background: linear-gradient(135deg, rgba(0,212,255,0.1), rgba(0,212,255,0.05)); border: var(--border-light); border-radius: var(--radius-lg); display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; gap: var(--sp-md); transition: all 0.3s; cursor: pointer;">
                <i class="fas fa-plus" style="font-size: 24px; color: var(--laser-blue);"></i>
                <span style="font-size: 14px; font-weight: 600; color: var(--text-primary);">Thêm Sản Phẩm</span>
            </a>
            <a href="{{ route('admin.products.index') }}" style="padding: var(--sp-lg); background: linear-gradient(135deg, rgba(139,92,246,0.1), rgba(139,92,246,0.05)); border: var(--border-light); border-radius: var(--radius-lg); display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; gap: var(--sp-md); transition: all 0.3s; cursor: pointer;">
                <i class="fas fa-box-open" style="font-size: 24px; color: var(--electric-violet);"></i>
                <span style="font-size: 14px; font-weight: 600; color: var(--text-primary);">Quản Lý Sản Phẩm</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" style="padding: var(--sp-lg); background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(16,185,129,0.05)); border: var(--border-light); border-radius: var(--radius-lg); display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; gap: var(--sp-md); transition: all 0.3s; cursor: pointer;">
                <i class="fas fa-shopping-cart" style="font-size: 24px; color: var(--success);"></i>
                <span style="font-size: 14px; font-weight: 600; color: var(--text-primary);">Xem Đơn Hàng</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" style="padding: var(--sp-lg); background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(245,158,11,0.05)); border: var(--border-light); border-radius: var(--radius-lg); display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; gap: var(--sp-md); transition: all 0.3s; cursor: pointer;">
                <i class="fas fa-tags" style="font-size: 24px; color: var(--warning);"></i>
                <span style="font-size: 14px; font-weight: 600; color: var(--text-primary);">Danh Mục</span>
            </a>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Chart color palette (matching brand)
    const chartColors = {
        primary: '#00d4ff',
        secondary: '#8b5cf6',
        success: '#10b981',
        danger: '#ef4444',
        warning: '#f59e0b',
        grid: 'rgba(255,255,255,0.1)'
    };

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            datasets: [{
                label: 'Doanh Thu (₫)',
                data: @json($monthlyRevenue ?? array_fill(0, 12, 0)),
                borderColor: chartColors.primary,
                backgroundColor: 'rgba(0,212,255,0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: chartColors.primary,
                pointBorderColor: '#080808',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: chartColors.grid, drawBorder: false },
                    ticks: { color: '#b0b0c0', font: { size: 11 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#b0b0c0', font: { size: 11 } }
                }
            }
        }
    });

    // Order Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: @json($orderStatuses ?? []),
            datasets: [{
                data: @json($orderStatusCounts ?? []),
                backgroundColor: [
                    '#00d4ff',
                    '#8b5cf6',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444'
                ],
                borderColor: '#080808',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#b0b0c0', font: { size: 11 }, padding: 15 }
                }
            }
        }
    });
</script>
@endsection
