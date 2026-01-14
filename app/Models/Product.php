<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'wholesale_price',
        'selling_price',
        'category',
        'image',
        'wholesaler_location'
    ];
    
}