<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * GET /api/admin/dashboard
     * Get dashboard statistics
     */
    public function dashboard()
    {
        $today = Carbon::now()->startOfDay();
        $thisMonth = Carbon::now()->startOfMonth();
        $thisYear = Carbon::now()->startOfYear();

        $totalRevenue = Order::where('order_status', '!=', 'cancelled')
            ->sum('total_price');

        $monthRevenue = Order::where('order_status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $thisMonth)
            ->sum('total_price');

        $todayRevenue = Order::where('order_status', '!=', 'cancelled')
            ->whereDate('created_at', $today)
            ->sum('total_price');

        $totalOrders = Order::count();
        $totalCustomers = User::count();
        $totalProducts = Product::count();

        return response()->json([
            'success' => true,
            'message' => 'Dashboard data retrieved successfully',
            'data' => [
                'total_revenue' => $totalRevenue,
                'month_revenue' => $monthRevenue,
                'today_revenue' => $todayRevenue,
                'total_orders' => $totalOrders,
                'total_customers' => $totalCustomers,
                'total_products' => $totalProducts,
            ]
        ]);
    }

    /**
     * GET /api/admin/reports
     * Get detailed reports with date filtering
     */
    public function index(Request $request)
    {
        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date')) : Carbon::now();

        // Revenue and order metrics
        $revenue = Order::where('order_status', '!=', 'cancelled')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_price');

        $revenueOrders = Order::where('order_status', '!=', 'cancelled')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        
        $canceledOrders = Order::where('order_status', 'cancelled')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // New customers
        $newCustomers = User::whereBetween('created_at', [$startDate, $endDate])->count();

        // Top products
        $topProducts = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->limit(10)
            ->get();

        // Daily revenue
        $dailyRevenue = Order::selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(total_price) as revenue')
            ->where('order_status', '!=', 'cancelled')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        // Orders by status
        $ordersByStatus = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('order_status, COUNT(*) as count')
            ->groupBy('order_status')
            ->get();

        // Payment methods
        $paymentMethods = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('payment_method, COUNT(*) as count')
            ->groupBy('payment_method')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Reports data retrieved successfully',
            'data' => [
                'revenue' => $revenue,
                'revenue_orders' => $revenueOrders,
                'total_orders' => $totalOrders,
                'canceled_orders' => $canceledOrders,
                'new_customers' => $newCustomers,
                'top_products' => $topProducts,
                'daily_revenue' => $dailyRevenue,
                'orders_by_status' => $ordersByStatus,
                'payment_methods' => $paymentMethods,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
            ]
        ]);
    }

    /**
     * GET /api/admin/reports/export
     * Export reports data
     */
    public function export(Request $request)
    {
        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date')) : Carbon::now();

        // Get report data
        $reportData = $this->getReportData($startDate, $endDate);

        // For CSV export, you would typically use a package like league/csv
        // For now, returning JSON that can be formatted as CSV
        
        return response()->json([
            'success' => true,
            'message' => 'Report export data ready',
            'data' => $reportData,
            'export_type' => 'csv'
        ]);
    }

    private function getReportData($startDate, $endDate)
    {
        return [
            'revenue' => Order::where('order_status', '!=', 'cancelled')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('total_price'),
            'total_orders' => Order::whereBetween('created_at', [$startDate, $endDate])->count(),
            'canceled_orders' => Order::where('order_status', 'cancelled')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'new_customers' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
        ];
    }
}
