<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProformaInvoiceList extends Model
{
    use HasFactory;
    protected $fillable = [
        'proforma_invoice_id',
        'product_name',
        'quantity',
        'unit_price',
        'total_price',
    ];
    public function proformaInvoice()
    {
        return $this->belongsTo(ProformaInvoice::class);
    }
}
