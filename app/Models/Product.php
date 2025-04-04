<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'category',
        'price',
        'stock',
        'image',
        'description',
        'created_date',
        'updated_date'
    ];
}
