<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'agency_id', 
        'phone',
        'message',
        'status',
        'content',
        'property_id',
        'receiver_id',
        'unread',
        'read_status',
        'vacance_id',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
    public function vacance()
    {
        return $this->belongsTo(Vacance::class, 'vacance_id');
    }
   

   
}