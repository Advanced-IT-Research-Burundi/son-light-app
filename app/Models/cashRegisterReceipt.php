<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cashRegisterReceipt extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'requerant_id',
        'user_id',
        'approbation_id',
        'amount',
        'motif',
        'note_validation',
        'cash_register_receipts_date',
        'cash_register_receipts_approbation_date',
    ];

    public function requerant()
    {
        return $this->belongsTo(User::class, 'requerant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approbation()
    {
        return $this->belongsTo(User::class, 'approbation_id');
    }
}
