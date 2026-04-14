<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSize extends Model
{
    protected $fillable = [
        'product_id',
        'size_id',
        'size_name',
        'stock_quantity',
    ];

    /**
     * Get the product this size belongs to
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the size this product size belongs to
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}
