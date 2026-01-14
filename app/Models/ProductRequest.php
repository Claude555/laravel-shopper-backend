<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    protected $fillable = ['customer_name', 'phone_number', 'item_description', 'status'];
}
