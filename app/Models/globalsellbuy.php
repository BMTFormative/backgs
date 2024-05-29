<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class globalsellbuy extends Model
{
    protected $table = 'globalsellbuys'; 
    public $timestamps = false; // Views typically don't have timestamps
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerId', 'id');
    }
}
