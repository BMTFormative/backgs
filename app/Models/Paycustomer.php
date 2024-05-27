<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paycustomer extends Model
{
    protected $fillable = [
        'SaleNumber', 'DatePayment', 'Amount'
    ];
}
