<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'invoice_id',
        'order_id',
        'user_id',
        'amount',
        'payment_date',
        'payment_method',
        'description',
    ];

    protected $with = ['order'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'user_id' => 'integer',
        'amount' => 'float',
        'payment_date' => 'date',
    ];

    // public function invoice(): BelongsTo
    // {
    //     return $this->belongsTo(Order::class, 'invoice_id');
    // }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
