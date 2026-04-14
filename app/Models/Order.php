<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;
use App\Models\OrderTracking;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_code',
        'subtotal',
        'shipping_fee',
        'discount_amount',
        'final_amount',
        'order_status',
        'payment_status',
        'payment_method',
        'shipping_address',
        'shipping_city',
        'shipping_district',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
    ];

    /**
     * Get the user that owns this order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Aliasing order_code as order_number for legacy views and search
     */
    public function getOrderNumberAttribute(): ?string
    {
        return $this->order_code;
    }

    /**
     * Get all order items for this order
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get all tracking records for this order
     */
    public function trackings(): HasMany
    {
        return $this->hasMany(OrderTracking::class);
    }
}
