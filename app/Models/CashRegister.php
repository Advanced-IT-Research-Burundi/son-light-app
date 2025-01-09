<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'opening_balance',
        'current_balance',
        'created_by',
        'updated_by',
    ];

    public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

public function updater()
{
    return $this->belongsTo(User::class, 'updated_by');
}

    /**
     * Récupère les reçus associés à cette caisse.
     */
    public function receipts()
    {
        return $this->hasMany(CashRegisterReceipt::class);
    }

    /**
     * Récupère les dénominations associées à cette caisse.
     */
    public function denominations()
    {
        return $this->hasMany(CashRegisterDenomination::class);
    }
}
