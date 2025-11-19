<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stripe_product_id',
        'stripe_price_id',
        'price',
        'currency',
        'billing_interval',
        'streams',
        'downloads',
        'quality',
        'resolution',
        'devices'
    ];
}
