<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerRegistration extends Model
{
    protected $fillable = [
        'activity_id', 'name', 'phone', 'origin', 'age', 
        'role', 'health_statement', 'status'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}