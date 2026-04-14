<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('shop.cart', compact('cart'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active) {
            return response()->json(['error' => 'Product is no longer available'], 400);
        }

        $selectedColor = $request->color ? trim($request->color) : null;
        $selectedSize = $request->size ? trim($request->size) : null;

        if ($selectedColor) {
            $colorVariant = $product->colors->firstWhere('color_name', $selectedColor);
            if (!$colorVariant) {
                return response()->json(['error' => 'Màu không hợp lệ cho sản phẩm này'], 400);
            }
            if ($colorVariant->stock_quantity < $request->quantity) {
                return response()->json(['error' => 'Số lượng màu này không đủ trong kho'], 400);
            }
        }

        if ($selectedSize) {
            $sizeVariant = $product->sizes->firstWhere('size_name', $selectedSize);
            if (!$sizeVariant) {
                return response()->json(['error' => 'Kích cỡ không hợp lệ cho sản phẩm này'], 400);
            }
            if ($sizeVariant->stock_quantity < $request->quantity) {
                return response()->json(['error' => 'Số lượng kích cỡ này không đủ trong kho'], 400);
            }
        }

        $cart = session()->get('cart', []);
        $cartKey = $this->getCartKey($request->product_id, $selectedColor, $selectedSize);

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {
            $cart[$cartKey] = [
                'product_id' => $request->product_id,
                'product_name' => $product->name,
                'product_slug' => $product->slug,
                'product_image' => $product->image,
                'price' => $product->discount_price ?? $product->price,
                'quantity' => $request->quantity,
                'color' => $selectedColor,
                'size' => $selectedSize,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cart_count' => count($cart),
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }

    /**
     * Helper to generate unique cart key
     */
    private function getCartKey($productId, $color = null, $size = null): string
    {
        return "product_{$productId}_color_{$color}_size_{$size}";
    }
}
