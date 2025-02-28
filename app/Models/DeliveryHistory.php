<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail_order_id',
        'quantity',
        'delivered_at',
        'status',
    ];

    public function detailOrder()
    {
        return $this->belongsTo(DetailOrder::class);
    }
}
