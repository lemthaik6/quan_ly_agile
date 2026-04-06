<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Trang báo cáo chính
     */
    public function index(Request $request)
    {
        $startDate = $request->get('from_date') ? \Carbon\Carbon::parse($request->from_date) : now()->subDays(30);
        $endDate = $request->get('to_date') ? \Carbon\Carbon::parse($request->to_date) : now();

        // Doanh thu
        $revenue = Order::where('payment_status', 'hoan_thanh')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('final_amount');

        $revenueOrders = Order::where('payment_status', 'hoan_thanh')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Đơn hàng
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        $completedOrders = Order::where('order_status', 'da_giao')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $canceledOrders = Order::where('order_status', 'da_huy')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Khách hàng mới
        $newCustomers = User::where('role', 'khach_hang')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Tổng khách hàng
        $totalCustomers = User::where('role', 'khach_hang')->count();

        // Sản phẩm bán chạy
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->select('products.id', 'products.name', DB::raw('SUM(order_items.quantity) as total_sold'), DB::raw('SUM(order_items.subtotal) as revenue'))
            ->where('orders.payment_status', 'hoan_thanh')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        // Doanh thu theo ngày
        $dailyRevenue = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as orders'),
                DB::raw('SUM(final_amount) as revenue')
            )
            ->where('payment_status', 'hoan_thanh')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        // Trạng thái đơn hàng
        $ordersByStatus = Order::select('order_status', DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('order_status')
            ->get();

        // Phương thức thanh toán
        $paymentMethods = Order::select('payment_method', DB::raw('COUNT(*) as count'), DB::raw('SUM(final_amount) as total'))
            ->where('payment_status', 'hoan_thanh')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('payment_method')
            ->get();

        // Danh mục sản phẩm
        $categories = Category::where('is_active', true)->get();

        // Tính toán tăng trưởng doanh thu so với hôm qua (nếu có)
        $yesterdayRevenue = Order::where('payment_status', 'hoan_thanh')
            ->whereDate('created_at', $startDate->copy()->subDay())
            ->sum('final_amount');
        $revenueGrowth = $yesterdayRevenue > 0 ? (($revenue - $yesterdayRevenue) / $yesterdayRevenue * 100) : 0;

        // Tính trung bình đơn
        $avgOrderValue = $revenueOrders > 0 ? round($revenue / $revenueOrders) : 0;

        // Đơn hàng theo trạng thái
        $orderStatusMap = [];
        foreach ($ordersByStatus as $status) {
            $orderStatusMap[$status->order_status] = $status->count;
        }

        $ordersPending = $orderStatusMap['dang_cho'] ?? 0;
        $ordersProcessing = $orderStatusMap['dang_xu_ly'] ?? 0;
        $ordersCompleted = $orderStatusMap['da_giao'] ?? 0;
        $ordersCancelled = $orderStatusMap['da_huy'] ?? 0;

        return view('admin.reports.index', compact(
            'revenue',
            'totalRevenue' => $revenue,
            'revenueOrders',
            'totalOrders',
            'completedOrders',
            'canceledOrders',
            'newCustomers',
            'totalCustomers',
            'topProducts',
            'dailyRevenue',
            'ordersByStatus',
            'paymentMethods',
            'categories',
            'startDate',
            'endDate',
            'revenueGrowth',
            'avgOrderValue',
            'ordersPending',
            'ordersProcessing',
            'ordersCancelled'
        ));
    }

    /**
     * Xuất báo cáo CSV
     */
    public function export(Request $request)
    {
        $startDate = $request->get('start_date') ? \Carbon\Carbon::parse($request->start_date) : now()->subDays(30);
        $endDate = $request->get('end_date') ? \Carbon\Carbon::parse($request->end_date) : now();

        $orders = Order::where('payment_status', 'hoan_thanh')
            ->with('user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $filename = 'report_' . now()->format('Y-m-d') . '.csv';
        $handle = fopen('php://memory', 'w');

        fputcsv($handle, ['Mã ĐH', 'Khách hàng', 'Tổng tiền', 'Ngày', 'Trạng thái'], ',');

        foreach ($orders as $order) {
            fputcsv($handle, [
                $order->order_number,
                $order->user->name ?? '',
                $order->final_amount,
                $order->created_at->format('d/m/Y'),
                $order->order_status
            ], ',');
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
