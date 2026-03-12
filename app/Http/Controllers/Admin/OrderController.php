<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Danh sách đơn hàng
     */
    public function index(Request $request)
    {
        $query = Order::with('user');

        // Tìm kiếm theo mã đơn hàng hoặc tên khách hàng
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('order_number', 'like', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
        }

        // Lọc theo trạng thái
        if ($request->has('status') && $request->status != '') {
            $query->where('order_status', $request->status);
        }

        // Lọc theo trạng thái thanh toán
        if ($request->has('payment_status') && $request->payment_status != '') {
            $query->where('payment_status', $request->payment_status);
        }

        // Sắp xếp
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $orders = $query->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Chi tiết đơn hàng
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items', 'tracking']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_status' => 'required|in:dang_cho,da_xac_nhan,dang_xu_ly,da_gui,da_giao,da_huy',
            'description' => 'nullable|string|max:255',
        ]);

        $order->update(['order_status' => $validated['order_status']]);

        // Tạo record theo dõi
        OrderTracking::create([
            'order_id' => $order->id,
            'status' => $validated['order_status'],
            'description' => $validated['description'] ?? null,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật!');
    }

    /**
     * Cập nhật trạng thái thanh toán
     */
    public function updatePaymentStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:dang_cho,hoan_thanh,that_bai,hoan_tien',
        ]);

        $order->update(['payment_status' => $validated['payment_status']]);

        return redirect()->back()->with('success', 'Trạng thái thanh toán đã được cập nhật!');
    }

    /**
     * Hủy đơn hàng
     */
    public function cancel(Order $order)
    {
        if (in_array($order->order_status, ['da_giao', 'da_huy'])) {
            return redirect()->back()->with('error', 'Không thể hủy đơn hàng này!');
        }

        $order->update(['order_status' => 'da_huy']);

        OrderTracking::create([
            'order_id' => $order->id,
            'status' => 'da_huy',
            'description' => 'Đơn hàng bị hủy',
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy!');
    }

    /**
     * Xuất hóa đơn PDF
     */
    public function export(Order $order)
    {
        // TODO: Implement PDF export later
        return redirect()->back()->with('info', 'Chức năng xuất PDF sẽ được cập nhật sớm!');
    }
}
