<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxe extends Model
{
    protected $fillable = [
        'TaxName', 'TaxRate', 'EffectiveDate', 'EndDate', 'Description'
    ];
}
