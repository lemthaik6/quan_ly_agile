<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\UpdateOrderStatusRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * GET /api/admin/orders
     * List all orders with filtering, search, and pagination
     */
    public function index(Request $request)
    {
        $query = Order::with('user', 'items', 'tracking');

        // Search by order number or customer name
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('order_number', 'like', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
        }

        // Filter by order status
        if ($request->has('status') && $request->status != '') {
            $query->where('order_status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status') && $request->payment_status != '') {
            $query->where('payment_status', $request->payment_status);
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $orders = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Orders retrieved successfully',
            'data' => $orders->items(),
            'pagination' => [
                'total' => $orders->total(),
                'per_page' => $orders->perPage(),
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'from' => $orders->firstItem(),
                'to' => $orders->lastItem(),
            ]
        ]);
    }

    /**
     * GET /api/admin/orders/{id}
     * Get a single order with its items and tracking
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items', 'tracking']);

        return response()->json([
            'success' => true,
            'message' => 'Order retrieved successfully',
            'data' => $order
        ]);
    }

    /**
     * POST /api/admin/orders/{id}/update-status
     * Update order status
     */
    public function updateStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        $validated = $request->validated();
        
        $order->update(['order_status' => $validated['order_status']]);
        $order->load(['user', 'items', 'tracking']);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'data' => $order
        ]);
    }

    /**
     * POST /api/admin/orders/{id}/update-payment-status
     * Update payment status
     */
    public function updatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,completed,failed,refunded',
        ]);

        $order->update(['payment_status' => $request->payment_status]);
        $order->load(['user', 'items', 'tracking']);

        return response()->json([
            'success' => true,
            'message' => 'Payment status updated successfully',
            'data' => $order
        ]);
    }

    /**
     * POST /api/admin/orders/{id}/cancel
     * Cancel an order
     */
    public function cancel(Order $order)
    {
        if ($order->order_status === 'delivered') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot cancel delivered orders'
            ], 409);
        }

        $order->update(['order_status' => 'cancelled']);
        $order->load(['user', 'items', 'tracking']);

        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully',
            'data' => $order
        ]);
    }

    /**
     * GET /api/admin/orders/{id}/export
     * Export order as PDF
     */
    public function export(Order $order)
    {
        // This would typically use a package like barryvdh/laravel-dompdf
        // For now, returning JSON export
        
        $order->load(['user', 'items', 'tracking']);

        return response()->json([
            'success' => true,
            'message' => 'Order export data',
            'data' => $order
        ]);
    }
}
