<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProformaInvoiceList extends Model
{
    use HasFactory;
    protected $fillable = [
        'proforma_invoice_id',
        'designation',
        'quantity',
        'unit_price',
        'unit',
        'total_price',
    ];

    protected $casts = [
        'proforma_invoice_id' => 'integer',
        'quantity' => 'integer',
        'designation' => 'string',
        'unit_price' => 'float',
        'total_price' => 'float',
    ];

    public function proformaInvoice(): BelongsTo
    {
        return $this->belongsTo(ProformaInvoice::class);
    }
    public function getFormattedUnitPriceAttribute(): string
    {
        return number_format($this->unit_price, 0, ',', '.') . ' FBU';
    }
    public function getFormattedTotalPriceAttribute(): string
    {
        return number_format($this->total_price, 0, ',', '.') . ' FBU';
    }
}
