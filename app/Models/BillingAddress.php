<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

   protected $table= 'billing_address'; 

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'country',
        'street_address',
        'city',
        'zip_code',
        'phone',
        'email'
    ];
}
