<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Globalpayment extends Model
{
    protected $fillable = ['DatePayment','Amount','CustomerId'];
}
