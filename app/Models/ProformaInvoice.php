<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProformaInvoice extends Model
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
        'company_id' => 'integer',
        'unit'=>'string',
        'price_letter'=>'string',
        'invoice_number'=>'string',
        'amount' => 'float',
        'quantity'=>'integer',
        'proforma_invoice_date'=>'date',
        'validity_period'=>'integer',
    ];
  /*
  protected $fillable = [
    'id',
    'client_id',
    'user_id',
    'company_id',
    'amount',
    'quantity',
    'proforma_invoice_date',
    'validity_period',
]; */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function proformaInvoiceList()
    {
        return $this->hasMany(ProformaInvoiceList::class);
    }
}
