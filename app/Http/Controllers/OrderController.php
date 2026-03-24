<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTracking;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Show checkout page
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty');
        }

        $user = auth()->user();

        return view('shop.checkout', compact('cart', 'user'));
    }

    /**
     * Process checkout and create order
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'payment_method' => 'required|in:cod,bank_transfer',
            'notes' => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = 30000; // Fixed shipping fee (VND)
        $discountAmount = 0;
        $finalAmount = $subtotal + $shippingFee - $discountAmount;

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_code' => 'ORD-' . strtoupper(Str::random(10)) . '-' . time(),
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'order_status' => 'pending',
            'payment_status' => $request->payment_method === 'cod' ? 'unpaid' : 'pending',
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->address,
            'shipping_city' => $request->city,
            'shipping_district' => $request->district,
            'notes' => $request->notes,
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'discount_per_unit' => 0,
                'subtotal' => $item['price'] * $item['quantity'],
                'selected_color' => $item['color'],
                'selected_size' => $item['size'],
            ]);

            // Update product sold count
            Product::find($item['product_id'])->increment('sold_count', $item['quantity']);
        }

        // Create initial order tracking
        OrderTracking::create([
            'order_id' => $order->id,
            'status' => 'pending',
            'description' => 'Đơn hàng của bạn đã được tạo thành công',
        ]);

        // Clear cart
        session()->forget('cart');

        return redirect()->route('order.confirmation', $order->order_code)
            ->with('success', 'Order placed successfully!');
    }

    /**
     * Show order confirmation page
     */
    public function confirmation($orderCode)
    {
        $order = Order::where('order_code', $orderCode)
            ->with(['orderItems.product', 'trackings'])
            ->firstOrFail();

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('shop.order-confirmation', compact('order'));
    }

    /**
     * Show user's orders list
     */
    public function myOrders()
    {
        $orders = auth()->user()->orders()
            ->with(['orderItems', 'trackings'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('shop.my-orders', compact('orders'));
    }

    /**
     * Show order detail and tracking
     */
    public function show($orderCode)
    {
        $order = Order::where('order_code', $orderCode)
            ->with(['orderItems.product', 'trackings' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }])
            ->firstOrFail();

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('shop.order-detail', compact('order'));
    }
}
