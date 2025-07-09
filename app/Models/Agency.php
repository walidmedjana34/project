<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Authenticatable
{
    use HasFactory;

    protected $table = 'agencies';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'wilaya',
        'commune',
        'agency_type',
        'password',
        'manager_name',
        'tax_identifier',
        'trade_register',
        'website',
        'logo',
        'description',
        'rating',
        'properties_available',
        'status',
        'is_premium',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'new_password',
    ];
   


    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
    public function profile()
{
    return $this->hasOne(Profile::class);
}
}
