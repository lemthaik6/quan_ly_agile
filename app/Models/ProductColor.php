<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductColor extends Model
{
    protected $fillable = [
        'product_id',
        'color_id',
        'color_name',
        'color_hex',
        'stock_quantity',
    ];

    /**
     * Get the product this color belongs to
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the color this product color belongs to
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
