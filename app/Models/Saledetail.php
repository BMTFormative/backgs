<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saledetail extends Model
{
    protected $fillable = ['SaleId','ProductId','Qty','PrixVente','TaxId','Montant','Discount','TaxAmount', 'TotalPriceWithTax'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'SaleId', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'id');
    }
    // public function tax()
    // {
    //     return $this->belongsTo(Tax::class, 'ProductId', 'id');
    // }
}
