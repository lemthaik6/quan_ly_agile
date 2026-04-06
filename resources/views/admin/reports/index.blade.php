@extends('layouts.admin')

@section('title', 'Báo Cáo Kinh Doanh')
@section('page-title', 'Báo Cáo')
@section('page-subtitle', 'Phân tích hiệu suất kinh doanh và thống kê')

@section('content')
<div style="display: flex; flex-direction: column; gap: var(--sp-2xl);">

    <!-- Header -->
    <div>
        <h2 style="margin: 0; font-size: 20px; font-weight: 600;">Báo Cáo Kinh Doanh</h2>
        <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--text-muted);">Phân tích doanh thu, đơn hàng, khách hàng</p>
    </div>

    <!-- Date Filter -->
    <div class="panel" style="padding: var(--sp-xl);">
        <form method="GET" style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: var(--sp-lg); align-items: flex-end;">
            <div>
                <label style="margin-bottom: var(--sp-sm);">Từ ngày</label>
                <input type="date" name="from_date" value="{{ request('from_date', now()->subDays(30)->format('Y-m-d')) }}" style="width: 100%;">
            </div>
            <div>
                <label style="margin-bottom: var(--sp-sm);">Đến ngày</label>
                <input type="date" name="to_date" value="{{ request('to_date', now()->format('Y-m-d')) }}" style="width: 100%;">
            </div>
            <div>
                <label style="margin-bottom: var(--sp-sm);">Danh mục</label>
                <select name="category_id" style="width: 100%;">
                    <option value="">Tất cả</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @empty
                    @endforelse
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="height: 40px; padding: 0 var(--sp-lg);">
                <i class="fas fa-filter"></i>
                <span>Lọc</span>
            </button>
        </form>
    </div>

    <!-- KPI Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--sp-lg);">

        <!-- Total Revenue Card -->
        <div class="panel-elevated" style="padding: var(--sp-xl);" >
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-lg);">
                <div>
                    <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Tổng Doanh Thu</p>
                    <p style="margin: 0; font-size: 28px; font-weight: 700; color: var(--laser-blue);">{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}₫</p>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(0,168,204,0.1)); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chart-line" style="font-size: 24px; color: var(--laser-blue);"></i>
                </div>
            </div>
            <div style="font-size: 12px; color: var(--text-muted);">
                <span>So với hôm qua:</span>
                <span style="color: var(--success); margin-left: var(--sp-sm);">
                    <i class="fas fa-arrow-up"></i> +{{ number_format($revenueGrowth ?? 0, 1) }}%
                </span>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="panel-elevated" style="padding: var(--sp-xl);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-lg);">
                <div>
                    <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Tổng Đơn Hàng</p>
                    <p style="margin: 0; font-size: 28px; font-weight: 700; color: var(--electric-violet);">{{ $totalOrders ?? 0 }}</p>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, rgba(139,92,246,0.2), rgba(168,85,247,0.1)); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-shopping-cart" style="font-size: 24px; color: var(--electric-violet);"></i>
                </div>
            </div>
            <div style="font-size: 12px; color: var(--text-muted);">
                <span>Hoàn tất:</span>
                <span style="color: var(--success); margin-left: var(--sp-sm);">{{ $completedOrders ?? 0 }}</span>
            </div>
        </div>

        <!-- Total Customers Card -->
        <div class="panel-elevated" style="padding: var(--sp-xl);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-lg);">
                <div>
                    <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Khách Hàng Mới</p>
                    <p style="margin: 0; font-size: 28px; font-weight: 700; color: var(--hot-pink);">{{ $newCustomers ?? 0 }}</p>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, rgba(255,0,110,0.2), rgba(255,40,140,0.1)); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-users" style="font-size: 24px; color: var(--hot-pink);"></i>
                </div>
            </div>
            <div style="font-size: 12px; color: var(--text-muted);">
                <span>Tổng khách:</span>
                <span style="color: var(--text-secondary); margin-left: var(--sp-sm);">{{ $totalCustomers ?? 0 }}</span>
            </div>
        </div>

        <!-- Conversion Rate Card -->
        <div class="panel-elevated" style="padding: var(--sp-xl);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--sp-lg);">
                <div>
                    <p style="margin: 0 0 var(--sp-xs) 0; font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Trung Bình Đơn</p>
                    <p style="margin: 0; font-size: 28px; font-weight: 700; color: var(--success);">{{ number_format($avgOrderValue ?? 0, 0, ',', '.') }}₫</p>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(52,211,153,0.1)); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-percent" style="font-size: 24px; color: var(--success);"></i>
                </div>
            </div>
            <div style="font-size: 12px; color: var(--text-muted);">
                <span>Từ</span>
                <span style="color: var(--text-secondary); margin-left: var(--sp-sm);">{{ $totalOrders ?? 0 }} đơn</span>
            </div>
        </div>

    </div>

    <!-- Data Tables Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-lg);">

        <!-- Top Products Table -->
        <div class="panel" style="overflow: hidden;">
            <div style="padding: var(--sp-xl); border-bottom: 1px solid rgba(255,255,255,0.08);">
                <h3 style="margin: 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--laser-blue);">
                    <i class="fas fa-star"></i> Sản Phẩm Bán Chạy
                </h3>
            </div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sản Phẩm</th>
                        <th style="text-align: right;">Số Lượng</th>
                        <th style="text-align: right;">Doanh Thu</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($topProducts as $index => $product)
                    <tr>
                        <td>
                            <span class="badge badge-primary" style="font-weight: 700;">{{ $index + 1 }}</span>
                        </td>
                        <td>
                            <p style="margin: 0; font-size: 13px; font-weight: 600;">{{ $product->name ?? 'N/A' }}</p>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-size: 13px; font-weight: 600;">x{{ $product->total_sold ?? 0 }}</span>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-size: 13px; font-weight: 600; color: var(--laser-blue);">{{ number_format($product->revenue ?? 0, 0, ',', '.') }}₫</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: var(--sp-lg);">
                            <p style="margin: 0; font-size: 12px; color: var(--text-muted);">Không có dữ liệu</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            </table>
        </div>

        <!-- Order Status Distribution -->
        <div class="panel" style="overflow: hidden;">
            <div style="padding: var(--sp-xl); border-bottom: 1px solid rgba(255,255,255,0.08);">
                <h3 style="margin: 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--laser-blue);">
                    <i class="fas fa-chart-pie"></i> Trạng Thái Đơn Hàng
                </h3>
            </div>
            <div style="padding: var(--sp-xl); display: flex; flex-direction: column; gap: var(--sp-lg);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: var(--sp-md);">
                        <div style="width: 12px; height: 12px; border-radius: 4px; background: var(--warning);"></div>
                        <span style="font-size: 13px;">Chờ xác nhận</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: var(--sp-md);">
                        <span style="font-size: 13px; font-weight: 600;">{{ $ordersPending ?? 0 }}</span>
                        <span style="font-size: 12px; color: var(--text-muted);">{{ round(($ordersPending ?? 0) / max($totalOrders ?? 1, 1) * 100, 1) }}%</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: var(--sp-md);">
                        <div style="width: 12px; height: 12px; border-radius: 4px; background: var(--info);"></div>
                        <span style="font-size: 13px;">Đang xử lý</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: var(--sp-md);">
                        <span style="font-size: 13px; font-weight: 600;">{{ $ordersProcessing ?? 0 }}</span>
                        <span style="font-size: 12px; color: var(--text-muted);">{{ round(($ordersProcessing ?? 0) / max($totalOrders ?? 1, 1) * 100, 1) }}%</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: var(--sp-md);">
                        <div style="width: 12px; height: 12px; border-radius: 4px; background: var(--success);"></div>
                        <span style="font-size: 13px;">Đã giao</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: var(--sp-md);">
                        <span style="font-size: 13px; font-weight: 600;">{{ $completedOrders ?? 0 }}</span>
                        <span style="font-size: 12px; color: var(--text-muted);">{{ round(($completedOrders ?? 0) / max($totalOrders ?? 1, 1) * 100, 1) }}%</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: var(--sp-md);">
                        <div style="width: 12px; height: 12px; border-radius: 4px; background: var(--error);"></div>
                        <span style="font-size: 13px;">Đã hủy</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: var(--sp-md);">
                        <span style="font-size: 13px; font-weight: 600;">{{ $ordersCancelled ?? 0 }}</span>
                        <span style="font-size: 12px; color: var(--text-muted);">{{ round(($ordersCancelled ?? 0) / max($totalOrders ?? 1, 1) * 100, 1) }}%</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Daily Revenue Table -->
    <div class="panel" style="overflow: hidden;">
        <div style="padding: var(--sp-xl); border-bottom: 1px solid rgba(255,255,255,0.08);">
            <h3 style="margin: 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--laser-blue);">
                <i class="fas fa-calendar-alt"></i> Doanh Thu Hàng Ngày
            </h3>
        </div>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th style="text-align: right;">Đơn Hàng</th>
                    <th style="text-align: right;">Doanh Thu</th>
                    <th style="text-align: right;">Đơn Bình Quân</th>
                    <th style="text-align: right;">% So Sánh</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dailyRevenue as $day)
                    <tr>
                        <td>
                            <span style="font-weight: 600; font-size: 13px;">{{ \Carbon\Carbon::parse($day->date)->format('d/m/Y') }}</span>
                            <p style="margin: 2px 0 0 0; font-size: 11px; color: var(--text-muted);">({{ \Carbon\Carbon::parse($day->date)->format('l') }})</p>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-size: 13px; font-weight: 600;">{{ $day->orders ?? 0 }}</span>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-size: 13px; font-weight: 600; color: var(--laser-blue);">{{ number_format($day->revenue ?? 0, 0, ',', '.') }}₫</span>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-size: 13px;">{{ number_format(($day->revenue ?? 0) / max($day->orders ?? 1, 1), 0, ',', '.') }}₫</span>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-size: 13px; color: var(--success);">
                                <i class="fas fa-arrow-up"></i>
                                0%
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: var(--sp-lg);">
                            <p style="margin: 0; font-size: 12px; color: var(--text-muted);">Không có dữ liệu</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
