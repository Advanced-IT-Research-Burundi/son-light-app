<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;

class Order extends Model
{
    use HasFactory, SoftDeletes;

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
        'id' => 'integer',
        'client_id' => 'integer',
        'user_id' => 'integer',
        'amount' => 'float',
        'order_date' => 'date',
        'delivery_date' => 'date',
        'unit'=>'string',
        'price_letter'=>'string',
        'status_livraison'=>'integer',
    ];

    protected $with = ['proformaInvoice'];
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

    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function proformaInvoice()
    {
        return $this->belongsTo(ProformaInvoice::class);
    }

    
}
   