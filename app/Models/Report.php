<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    protected $fillable = [
        'ticket_number',
        'is_anonymous',
        'reporter_name',
        'reporter_phone',
        'photo_path',
        'latitude',
        'longitude',
        'location_name',
        'address_details',
        'density_level',
        'impacts',
        'notes',
        'status',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'impacts' => 'array',
    ];

    // Menghasilkan URL foto laporan
    public function getPhotoUrlAttribute()
    {
        if (empty($this->photo_path)) {
            return null;
        }

        if (!Storage::disk('public')->exists($this->photo_path)) {
            return null;
        }

        return Storage::disk('public')->url($this->photo_path);
    }

    // Relasi riwayat status
    public function statusHistories(): HasMany
    {
        return $this->hasMany(ReportStatusHistory::class)
            ->orderBy('created_at', 'asc');
    }

    // Relasi komentar
    public function comments(): HasMany
    {
        return $this->hasMany(ReportComment::class)
            ->orderBy('created_at', 'asc');
    }
}
