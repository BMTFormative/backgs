<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class totalpayment extends Model
{
    protected $table = 'totalpayments'; 
    public $timestamps = false; // Views typically don't have timestamps
}
