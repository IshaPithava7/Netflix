<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $fillable = [
        'name',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'user_id',
        'ends_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isActive()
    {
        return $this->stripe_status === 'active';
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}


