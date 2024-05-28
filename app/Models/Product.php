<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['Reference', 'Designation', 'Marque', 'Prix', 'Quantity', 'Rayon'];

    public function qtyChange()
    {
        return $this->hasOne(ProductQtyChange::class, 'ProductId', 'id');
        // Adjust the 'ProductId' and 'id' based on your actual column names
    }
}
