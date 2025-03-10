<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'aisle_id',
        'cateigorie_id',
        'name',
        'description',
        'prace',
        'rating',
        'sale_price'

    ];
}
