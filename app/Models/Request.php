<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'agency_type',
        'password',
        'manager_name',
        'tax_identifier',
        'trade_register',
        'website',
        'logo',
        'description',
    ];

   
}
