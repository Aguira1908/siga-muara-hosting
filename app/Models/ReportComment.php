<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportComment extends Model
{
    protected $fillable = [
        'report_id',
        'sender_type',
        'sender_name',
        'message',
        'user_id',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
