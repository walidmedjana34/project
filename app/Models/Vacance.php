<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacance extends Model
{
    use HasFactory;

    protected $table = 'vacances';

    protected $fillable = [
        'titre',
        'description',
        'localisation',
        'wilaya',
        'commune',
        'prix_nuit',
        'chambres',
        'salles_bain',
        'capacite',
        'superficie',
        'type',
        'type_annonce',
        'wifi',
        'parking',
        'piscine',
        'cuisine',
        'television',
        'climatisation',
        'main_image',
        'disponible_de',
        'disponible_jusqua',
        'statut',
        'admin_status',
        'agency_id',
        'user_id',
    ];

    protected $casts = [
        
        'disponible_de' => 'date',
        'disponible_jusqua' => 'date',
        'main_image'=> 'array',
    ];

    // Prix formaté
    public function getPrixFormateAttribute()
    {
        return number_format($this->prix_nuit, 0, ',', ' ') . ' DA';
    }

    // Locations de vacances disponibles
    public function scopeLocationsDisponibles($query)
    {
        return $query->where('type_annonce', 'location')
                    ->where('statut', 'disponible');
    }
    public function agency()
{
    return $this->belongsTo(Agency::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}

}