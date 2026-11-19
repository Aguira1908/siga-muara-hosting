<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'is_anonymous',
        'donor_name',
        'origin_rantau',
        'type',
        'item_details',
        'payment_method',
        'transfer_amount',
        'proof_path',
        'message',
        'status',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'transfer_amount' => 'integer',
    ];
}