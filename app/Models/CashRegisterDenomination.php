<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegisterDenomination extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash_register_id',
        'denomination',
        'quantity',
    ];

    // Relation avec la caisse principale
    public function cashRegister()
    {
        return $this->belongsTo(CashRegister::class);
    }

    // Calculer le total de cette dénomination
    public function total()
    {
        return $this->denomination * $this->quantity;
    }
}
