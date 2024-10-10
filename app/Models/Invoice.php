<?php

// app/Models/Invoice.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'proforma_id',
        'number',
        'date',
        'due_date',
        'total_amount',
        'status'
    ];

    public function proforma()
    {
        return $this->belongsTo(Proforma::class);
    }
}

