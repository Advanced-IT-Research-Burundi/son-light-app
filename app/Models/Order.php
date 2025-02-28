<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    // Types de commandes
    const TYPE_DIRECT = 'direct';
    const TYPE_PROFORMA = 'proforma';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'client_id'        => 'integer',
        'user_id'          => 'integer',
        'amount'           => 'float',
        'order_date'       => 'date',
        'delivery_date'    => 'date',
        'status_livraison'  => 'integer',
        'pf'               => 'float',
        'tc'               => 'float',
        'atax'             => 'float',
        'type_commande'    => 'string', // ajout du cast pour le type de commande
    ];

    protected $with = ['proformaInvoice'];

    // Relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function detailOrders(): HasMany
    {
        return $this->hasMany(DetailOrder::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function proformaInvoice(): BelongsTo
    {
        return $this->belongsTo(ProformaInvoice::class);
    }

    // Méthodes supplémentaires

    public function isDelivered(): bool
    {
        return $this->status_livraison === 1; // ou tout autre statut qui représente 'livré'
    }

    public function totalAmount(): float
    {
        return $this->detailOrders->sum('total_price');
    }

    /**
     * Vérifier si la commande est une commande par facture pro forma.
     *
     * @return bool
     */
    public function isProforma(): bool
    {
        return $this->type_commande === self::TYPE_PROFORMA;
    }

    /**
     * Vérifier si la commande est une commande directe.
     *
     * @return bool
     */
    public function isDirect(): bool
    {
        return $this->type_commande === self::TYPE_DIRECT;
    }
}
