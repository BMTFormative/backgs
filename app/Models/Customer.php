<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'Nom', 'Prorietaire', 'Address', 'City', 'Country', 'Phone', 'Mobile', 'Fax', 'Email'
    ];
}

