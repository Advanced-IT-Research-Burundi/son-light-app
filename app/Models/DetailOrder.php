<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_name',
        'quantity',
        'unit_price',
        'unit',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
