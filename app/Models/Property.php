<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'title',
        'description',
        'price',
        'wilaya',
        'commune',
        'address',
        'type',         // apartment, house, land, commercial
        'status',       // available, sold, rented
        'bedrooms',
        'bathrooms',
        'surface',
        'features',     // Stocké en JSON
        'main_image',   // chemin vers l’image principale
        'agency_id',
        'etat_bien',
        'admin_status',
        'user_id',
        'is_premium',
    ];

    protected $casts = [
        'features' => 'array',
        'main_image'=> 'array',
    ];

  
    public function agency()
{
    return $this->belongsTo(Agency::class);
}
// In Property.php (Model)
public function scopeApproved($query)
{
    return $query->where('admin_status', 'approved');
}
public function visits()
    {
        return $this->hasMany(Visit::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}


    
}
