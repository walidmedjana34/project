<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'user_id',
        'vacance_id',
    'property_id',
    'agency_id',
    'scheduled_date',
    'phone',
    'notes',
    'status'
    ];
    protected $casts = [
        'scheduled_date' => 'datetime',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function vacance()
    {
        return $this->belongsTo(Vacance::class, 'vacance_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
