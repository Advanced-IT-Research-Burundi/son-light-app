<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'quantity_entered',
        'entry_date',
        'supplier',
        'entry_notes'
    ];

    protected $dates = ['entry_date'];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
