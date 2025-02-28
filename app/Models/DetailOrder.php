<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    /**
     * Attributs remplissables.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_name',
        'quantity',
        'unit_price',
        'unit',
        'total_price',
        'pf',
        'tc',
        'atax',
    ];

    /**
     * Relation avec le modèle Order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
