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

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client_id' => 'integer',
        'user_id' => 'integer',
        'company_id' => 'integer',
        'unit' => 'string',
        'price_letter' => 'string',
        'invoice_number' => 'string',
        'amount' => 'float',
        'quantity' => 'integer',
        'proforma_invoice_date' => 'date',
        'validity_period' => 'integer',
        'pf' => 'float', // Préciser le type float pour plus de clarté
        'tc' => 'float', // Préciser le type float pour plus de clarté
        'atax' => 'float', // Préciser le type float pour plus de clarté
    ];

    /**
     * Relation avec l'utilisateur.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le client.
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relation avec l'entreprise.
     *
     * @return BelongsTo
     */
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Relation avec la liste des factures pro forma.
     *
     * @return HasMany
     */
    public function proformaInvoiceList(): HasMany
    {
        return $this->hasMany(ProformaInvoiceList::class);
    }

    /**
     * Accesseur pour formater le montant en monnaie locale (FBU).
     *
     * @return string
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 0, ',', '.') . ' FBU'; // Formatage pour FBU
    }

    /**
     * Accesseur pour obtenir le nombre de jours de validité.
     *
     * @return string
     */
    public function getValidityPeriodInDaysAttribute(): string
    {
        return $this->validity_period . ' jours';
    }
}
