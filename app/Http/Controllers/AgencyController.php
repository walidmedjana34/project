<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AgencyPendingApprovalMail;
use App\Mail\AgencyApprovedMail;
use App\Mail\AgencyRefusedMail;
class AgencyController 
{
    public function index()
{
    // Récupère uniquement les agences approuvées
    $agencies = Agency::where('status', 'approved')
                     ->orderBy('created_at', 'desc')
                     ->get();
    
    return view('laravel-examples.agency-management', compact('agencies'));
}
    public function approve(Agency $agency)
    {
        // Update the agency status to approved
        $agency->update(['status' => 'approved']);
        if ($agency->email) {
            Mail::to($agency->email)->send(new AgencyApprovedMail($agency));
        }
        // Redirect back with success message
        return back()->with('success', 'Agence approuvée avec succès');
    }
    
    public function reject(Agency $agency)
    {
        // Update the agency status to rejected
        $agency->update(['status' => 'rejected']);
        if ($agency->email) {
            Mail::to($agency->email)->send(new AgencyRefusedMail($agency));
        }
        // Redirect back with success message
        return back()->with('success', 'Agence rejetée avec succès');
    }
    public function store(Request $request)
    {
       
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agencies,email',
            'phone_number' => 'required|string|max:20', // Add this line
            'address' => 'required|string|max:255',
            'wilaya' => 'required|string',
             'commune' => 'required|string',
            'agency_type' => 'required|string|max:50|in:Vente,Location,Consultation,Multi-services',
            'password' => 'required|string|min:8|confirmed',
            'manager_name' => 'required|string|max:255',
            'tax_identifier' => 'required|string|max:50',
            'trade_register' => 'required|string|max:50',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);
    
     // Handle file upload (logo)
    $logoBase64 = null;
    if ($request->hasFile('logo')) {
        $image = $request->file('logo');
        $logoBase64 = base64_encode(file_get_contents($image->getRealPath()));
    }
    
        
       // Create the agency with ALL fields
    $agency = Agency::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'wilaya' => $request->wilaya, // Add this
        'commune' => $request->commune, // Add this
        'agency_type' => $request->agency_type,
        'password' => bcrypt($request->password),
        'manager_name' => $request->manager_name,
        'tax_identifier' => $request->tax_identifier,
        'trade_register' => $request->trade_register,
        'website' => $request->website,
        'description' => $request->description, // Add this
        'logo' => $logoBase64,
        'status' => 'pending', // Default status
    ]);
    Mail::to($agency->email)->send(new AgencyPendingApprovalMail($agency));
        // Redirect or return a response
        return redirect('/')->with('success', 'Agency created successfully!');
    }

    public function show(Agency $agency)
    {
        return response()->json($agency);
    }
    
    public function edit(Agency $agency)
    {
        return response()->json($agency);
    }

    public function update(Request $request, Agency $agency)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agencies,email,' . $agency->id,
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'agency_type' => 'required|string|max:50',
            'manager_name' => 'required|string|max:255',
            'tax_identifier' => 'required|string|max:50',
            'trade_register' => 'required|string|max:50|unique:agencies,trade_register,' . $agency->id,
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle file upload (logo)
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        } else {
            $logoPath = $agency->logo;
        }
    
        // Update the agency
        $agency->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'agency_type' => $request->agency_type,
            'manager_name' => $request->manager_name,
            'tax_identifier' => $request->tax_identifier,
            'trade_register' => $request->trade_register,
            'website' => $request->website,
            'logo' => $logoPath,
        ]);
    
        // Redirect or return a response
        return redirect()->route('agency-management')->with('success', 'Agency updated successfully!');
    }

    public function destroy(Agency $agency)
    {
        // Delete the agency
        $agency->delete();
    
        // Return a response
        return response()->json(['message' => 'Agency deleted successfully!']);
    }
    public function indexx(Request $request)
    {
        $query = Agency::where('status', 'approved');
    
        // Filtres
        if ($request->filled('wilaya')) {
            $query->where('wilaya', $request->wilaya);
            
            if ($request->filled('commune')) {
                $query->where('commune', $request->commune);
            }
        }
    
        // Filtre par type d'agence (directement en français)
        if ($request->filled('agency_type')) {
            $query->where('agency_type', $request->agency_type);
        }
    
        // Tri
        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'name_asc' => $query->orderBy('name', 'asc'),
            'name_desc' => $query->orderBy('name', 'desc'),
            'rating' => $query->orderBy('rating', 'desc'),
            default => $query->latest(),
        };
    
        $agencies = $query->paginate(6);
        
        $wilayas = config('wilayas');
        $communes = $request->filled('wilaya') 
            ? config("communes.{$request->wilaya}", []) 
            : [];
    
        return view('agence.agences', compact('agencies', 'wilayas', 'communes'));
    }
    public function profile($id)
    {
        $agency = Agency::findOrFail($id); // Récupère toutes les agences
        return view('agence.profile', compact('agency'));
    }
    public function indexxx()
{
    // Récupère uniquement les agences avec statut "pending"
    $agencies = Agency::where('status', 'pending')
                     ->orderBy('created_at', 'desc')
                     ->get();
    
    // Compteurs (optionnel - si vous gardez les statistiques)
    $counts = [
        'approved' => Agency::where('status', 'approved')->count(),
        'rejected' => Agency::where('status', 'rejected')->count(),
        'pending' => Agency::where('status', 'pending')->count()
    ];

    return view('laravel-examples.agency-request-management', [
        'agencies' => $agencies,
        'counts' => $counts
    ]);
}





    
}