<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location_name',
        'date',
        'time',
        'meeting_point',
        'volunteer_needed',
        'pic_name',
        'pic_phone',
        'safety_notes',
        'status',
    ];

    public function volunteers(): HasMany
    {
        return $this->hasMany(VolunteerRegistration::class);
    }
}
