<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class AccueilController
{
  public function index()
{
    $annonces = Property::join('agencies', 'properties.agency_id', '=', 'agencies.id')
        ->select('properties.*')
        ->orderByRaw('agencies.is_premium DESC, agencies.is_pro DESC, properties.created_at DESC')
        ->paginate(6);

    return view('home.Accueil', compact('annonces'));
}

}
