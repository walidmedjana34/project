<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        
    ];
    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
}