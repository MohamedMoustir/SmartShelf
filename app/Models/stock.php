<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
    ];
}
