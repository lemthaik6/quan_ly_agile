<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Review;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'cost_price',
        'discount_price',
        'quantity_in_stock',
        'sold_count',
        'sku',
        'image',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the category that owns this product
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all order items for this product
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get all colors available for this product
     */
    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    /**
     * Get all sizes available for this product
     */
    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    /**
     * Get all reviews for this product
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get average rating for this product
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->where('is_verified_purchase', true)->avg('rating') ?? 0;
    }

    /**
     * Get review count for this product
     */
    public function getReviewCountAttribute(): int
    {
        return $this->reviews()->where('is_verified_purchase', true)->count();
    }
}
