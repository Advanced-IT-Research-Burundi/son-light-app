<?php

// app/Models/Invoice.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'updated_by',
        'number',
        'date',
        'due_date',
        'total_amount',
        'status',
        'id_true_invoice',
        'user_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function updatedBy()
      {
         return $this->belongsTo(User::class, 'updated_by');
       }
}

