<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Dashboard - Hiển thị thống kê tổng quan
     */
    public function dashboard()
    {
        // Thống kê sản phẩm
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', 1)->count();
        $totalCategories = Category::count();

        // Thống kê đơn hàng
        $totalOrders = Order::count();
        $pendingOrders = Order::where('order_status', 'dang_cho')->count();
        $completedOrders = Order::where('order_status', 'da_giao')->count();
        $totalRevenue = Order::where('payment_status', 'hoan_thanh')->sum('final_amount');

        // Thống kê khách hàng
        $totalCustomers = User::where('role', 'khach_hang')->count();
        $newCustomersThisMonth = User::where('role', 'khach_hang')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Đơn hàng gần đây
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Sản phẩm bán chạy
        $topProducts = Product::select('id', 'name', 'price', 'sold_count', 'quantity_in_stock')
            ->where('is_active', 1)
            ->orderBy('sold_count', 'desc')
            ->limit(5)
            ->get();

        // Doanh thu theo tháng (6 tháng gần đây)
        $monthlyRevenue = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(final_amount) as revenue')
            )
            ->where('payment_status', 'hoan_thanh')
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function($item) {
                return [
                    'month' => $this->getMonthName($item->month),
                    'revenue' => $item->revenue
                ];
            });

        // Phân bố trạng thái đơn hàng
        $orderStatusDistribution = [
            'dang_cho' => Order::where('order_status', 'dang_cho')->count(),
            'dang_xu_ly' => Order::where('order_status', 'dang_xu_ly')->count(),
            'dang_giao' => Order::where('order_status', 'dang_giao')->count(),
            'da_giao' => Order::where('order_status', 'da_giao')->count(),
            'da_huy' => Order::where('order_status', 'da_huy')->count(),
        ];

        // Doanh thu hôm nay
        $todayRevenue = Order::where('payment_status', 'hoan_thanh')
            ->whereDate('created_at', now()->today())
            ->sum('final_amount');

        // Đơn hàng hôm nay
        $todayOrders = Order::whereDate('created_at', now()->today())->count();

        // Top 5 sản phẩm bán chạy nhất
        $topSellingProducts = Product::select('name', 'sold_count', 'price')
            ->where('is_active', 1)
            ->orderBy('sold_count', 'desc')
            ->limit(5)
            ->get();

        // Khách hàng mới trong 7 ngày
        $newCustomers = User::where('role', 'khach_hang')
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'totalCategories',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalRevenue',
            'totalCustomers',
            'newCustomersThisMonth',
            'recentOrders',
            'topProducts',
            'monthlyRevenue',
            'orderStatusDistribution',
            'todayRevenue',
            'todayOrders',
            'topSellingProducts',
            'newCustomers'
        ));
    }

    /**
     * Lấy tên tháng từ số
     */
    private function getMonthName($month)
    {
        $months = [
            1 => 'Tháng 1',
            2 => 'Tháng 2',
            3 => 'Tháng 3',
            4 => 'Tháng 4',
            5 => 'Tháng 5',
            6 => 'Tháng 6',
            7 => 'Tháng 7',
            8 => 'Tháng 8',
            9 => 'Tháng 9',
            10 => 'Tháng 10',
            11 => 'Tháng 11',
            12 => 'Tháng 12'
        ];
        return $months[$month] ?? '';
    }
}
