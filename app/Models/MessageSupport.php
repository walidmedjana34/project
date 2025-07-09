<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageSupport extends Model
{
    use HasFactory;
    protected $table = 'message_support'; 

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read'
    ];
}