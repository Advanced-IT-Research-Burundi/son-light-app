<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockExit extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'quantity_exited',
        'exit_date',
        'destination',
        'exit_notes'
    ];

    protected $dates = ['exit_date'];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
