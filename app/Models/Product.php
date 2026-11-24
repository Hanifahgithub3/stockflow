<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'product_code',
        'product_name',
        'unit',
        'minimum_stock',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->current_stock <= 0) return 'Habis';
        if ($this->current_stock <= $this->minimum_stock) return 'Menipis';
        return 'Aman';
    }
}