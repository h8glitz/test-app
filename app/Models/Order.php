<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_comment',
        'product_id',
        'quantity',
        'status',
        'created_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Рассчёт итоговой цены (product.price * quantity)
    public function getTotalPriceAttribute()
    {
        if (!$this->product) {
            return 0;
        }
        return $this->product->price * $this->quantity;
    }
}
