<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProformaInvoiceList extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'proforma_invoice_id',
        'product_name',
        'quantity',
        'unit_price',
        'unit',
        'total_price',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'proforma_invoice_id' => 'integer',
        'quantity' => 'integer',
        'unit_price' => 'float',
        'total_price' => 'float',
    ];

    /**
     * Relation avec la facture pro forma.
     *
     * @return BelongsTo
     */
    public function proformaInvoice(): BelongsTo
    {
        return $this->belongsTo(ProformaInvoice::class);
    }

    /**
     * Accesseur pour formater le prix unitaire en monnaie locale (FBU).
     *
     * @return string
     */
    public function getFormattedUnitPriceAttribute(): string
    {
        return number_format($this->unit_price, 0, ',', '.') . ' FBU';
    }

    /**
     * Accesseur pour formater le prix total en monnaie locale (FBU).
     *
     * @return string
     */
    public function getFormattedTotalPriceAttribute(): string
    {
        return number_format($this->total_price, 0, ',', '.') . ' FBU';
    }
}
