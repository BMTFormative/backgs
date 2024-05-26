<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'ArrivalNumber', 'DateArrival', 'SupplierId', 'ProductId', 
        'Qty', 'PrixAchat', 'PrixGros', 'PrixDetail'
    ];
}

