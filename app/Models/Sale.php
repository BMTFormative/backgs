<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['SaleNumber', 'DateSale','SaleId', 'OrderType', 'CustomerId', 'ProductId', 'TaxId', 'TotalAmount','TotalTax','TotalDiscount','TotalAmountWith'];

    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerId', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'id');
    }
    public function saledetail()
    {
        return $this->hasMany(Saledetail::class, 'SaleId', 'id');
    }
    public function totalPayment() {
        return $this->hasOne(TotalPayment::class, 'SaleNumber', 'SaleNumber');
    }
}

