<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProformaInvoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'client_id' => 'integer',
        'user_id' => 'integer',
        'company_id' => 'integer',
        'unit' => 'string',
        'price_letter' => 'string',
        'invoice_number' => 'string',
        'designation' => 'string',
        'quantity' => 'integer',
        'amount' => 'float',
        'proforma_invoice_date' => 'date',
        'validity_period' => 'integer',
        'pf' => 'float', 
        'tc' => 'float', 
        'atax' => 'float', 
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function proformaInvoiceList(): HasMany
    {
        return $this->hasMany(ProformaInvoiceList::class);
    }
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 0, ',', '.') . ' FBU';
    }
    public function getValidityPeriodInDaysAttribute(): string
    {
        return $this->validity_period . ' jours';
    }
}
