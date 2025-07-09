<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use App\Models\Property;
use App\Models\Vacance;
class ProfileController
{
    public function show()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Passer les informations de l'utilisateur à la vue
        return view('agence.Agency_Dashboard', compact('user'));

    }
    
    public function visit()
    {
        // Show Properties Management view
        $user = Auth::user(); // If you need user data
        return view('agence.visite_agence', compact('user'));
    }
    
    public function setting()
    {
        $agency = auth('agency')->user();
        return view('agence.paramettre_agence', compact('agency'));
    }
    public function updatePassword(Request $request)
{
    $validated = $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    /** @var Agency $agency */
    $agency = auth('agency')->user();

    if (!Hash::check($request->current_password, $agency->password)) {
        return back()->with('error', 'Current password is incorrect');
    }

    $agency->password = Hash::make($request->new_password);
    $agency->save(); // This should now be recognized

    return back()->with('success', 'Password updated!');
}
public function update(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'telephone' => 'nullable|string|max:20'
        ]);

        // Update the authenticated user directly
        Auth::user()->update([
            'name' => $request->nom,
            'email' => $request->email,
            'phone' => $request->telephone
        ]);

        return back()->with('success', 'Profil mis à jour!');
    }
    // In ProfileController.php
    public function dashboard()
    {
        $users = Auth::user();
        
        // Get visits for this client
        $visits = \App\Models\Visit::with(['property', 'agency'])
                    ->where('user_id', $users->id)
                    ->orderBy('scheduled_date', 'desc')
                    ->get();
        
        // Separate visits
        $upcomingVisits = $visits->where('scheduled_date', '>=', now())
                            ->where('status', '!=', 'canceled');
        
        $pastVisits = $visits->where(function($query) {
                            return $query->where('scheduled_date', '<', now())
                                        ->orWhere('status', 'canceled');
                        });
        
        return view('client.dashboard', compact('users', 'upcomingVisits', 'pastVisits'));
    }
      public function updatee(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|in:appartement,bungalow,carcasse,villa',
            'status' => 'required|in:a_vendre,vendu,a_louer',
            'wilaya' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'surface' => 'required|numeric|min:0',
            'etat_bien' => 'required|in:neuf,renove,bon-etat,a-renover',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       

        // Update the property
        $property->update($validatedData);

        return redirect()->back()->with('success', 'Property updated successfully!');
    }
    
    // ... other methods ...

    /**
     * Update the specified resource in storage.
     */
    public function updateee(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix_nuit' => 'required|numeric|min:0',
            'type' => 'required|string',
            'statut' => 'required|string',
            'wilaya' => 'required|string',
            'commune' => 'required|string',
            'localisation' => 'required|string',
            'chambres' => 'required|integer|min:1',
            'salles_bain' => 'required|integer|min:1',
            'capacite' => 'required|string',
            'superficie' => 'nullable|numeric',
            'type_annonce' => 'required|string',
            'disponible_de' => 'nullable|date',
            'disponible_jusqua' => 'nullable|date|after_or_equal:disponible_de',
            'agency_id' => 'required|exists:agencies,id',
        ]);

        // Find the property to update
        $vacance = Vacance::findOrFail($id);

        // Update the property with validated data
        $vacance->update($validatedData);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Property updated successfully!');
    }
    public function destroy($id)
{
    $property = Vacance::findOrFail($id);
    
    // If there's an image or related files, you can unlink them here
    // e.g. Storage::delete($property->main_image);

    $property->delete();

    return redirect()->back()->with('success', 'Annonce supprimée avec succès.');
}
 public function destroyy($id)
{
    $property = Property::findOrFail($id);
    
    // If there's an image or related files, you can unlink them here
    // e.g. Storage::delete($property->main_image);

    $property->delete();

    return redirect()->back()->with('success', 'Annonce supprimée avec succès.');
}

    // ... other methods ...
}
