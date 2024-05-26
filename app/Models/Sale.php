<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['SaleNumber', 'DateSale', 'OrderType', 'SupplierId', 'ProductId', 'Qty', 'Prix'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierId', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'id');
    }
}

