<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'code',
        'quantity',
        'unit',
        'min_quantity',
        'description',
        'last_restock_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'last_restock_date' => 'date',
    ];

    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function entries()
    {
        return $this->hasMany(StockEntry::class);
    }

    public function exits()
    {
        return $this->hasMany(StockExit::class);
    }
}
