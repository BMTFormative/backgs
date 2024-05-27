<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['SaleNumber', 'DateSale', 'OrderType', 'CustomerId', 'ProductId', 'Qty', 'Prix'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerId', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'id');
    }
}

