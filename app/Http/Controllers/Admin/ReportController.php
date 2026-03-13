<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Trang báo cáo chính
     */
    public function index(Request $request)
    {
        $startDate = $request->get('start_date') ? \Carbon\Carbon::parse($request->start_date) : now()->subDays(30);
        $endDate = $request->get('end_date') ? \Carbon\Carbon::parse($request->end_date) : now();

        // Doanh thu
        $revenue = Order::where('payment_status', 'hoan_thanh')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('final_amount');

        $revenueOrders = Order::where('payment_status', 'hoan_thanh')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Đơn hàng
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        $canceledOrders = Order::where('order_status', 'da_huy')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Khách hàng mới
        $newCustomers = User::where('role', 'khach_hang')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Sản phẩm bán chạy
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.id', 'products.name', DB::raw('SUM(order_items.quantity) as total_sold'), DB::raw('SUM(order_items.subtotal) as revenue'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->whereBetween('order_items.created_at', [$startDate, $endDate])
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

        return view('admin.reports.index', compact(
            'revenue',
            'revenueOrders',
            'totalOrders',
            'canceledOrders',
            'newCustomers',
            'topProducts',
            'dailyRevenue',
            'ordersByStatus',
            'paymentMethods',
            'startDate',
            'endDate'
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
