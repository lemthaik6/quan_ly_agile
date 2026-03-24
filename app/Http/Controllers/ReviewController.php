<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Show review page for a product
     */
    public function create($productSlug)
    {
        $product = Product::where('slug', $productSlug)
            ->where('is_active', true)
            ->firstOrFail();

        // Check if user has purchased this product
        $orderItem = OrderItem::whereHas('order', function ($q) {
            $q->where('user_id', auth()->id())->where('order_status', '!=', 'cancelled');
        })
            ->where('product_id', $product->id)
            ->first();

        if (!$orderItem) {
            return redirect()->route('product.show', $product->slug)
                ->with('error', 'You must purchase this product to leave a review');
        }

        // Check if already reviewed
        $existingReview = Review::where('product_id', $product->id)
            ->where('user_id', auth()->id())
            ->first();

        return view('shop.review', compact('product', 'existingReview'));
    }

    /**
     * Store review
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if user has purchased this product
        $orderItem = OrderItem::whereHas('order', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->where('product_id', $product->id)
            ->first();

        if (!$orderItem) {
            return back()->with('error', 'You must purchase this product to leave a review');
        }

        // Check if already reviewed
        $existingReview = Review::where('product_id', $product->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            // Update existing review
            $existingReview->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            $message = 'Review updated successfully';
        } else {
            // Create new review
            Review::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'order_item_id' => $orderItem->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_verified_purchase' => true,
            ]);
            $message = 'Review submitted successfully';
        }

        return redirect()->route('product.show', $product->slug)
            ->with('success', $message);
    }
}
