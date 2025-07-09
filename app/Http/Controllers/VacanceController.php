<?php

namespace App\Http\Controllers;

use App\Models\Vacance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\VacationApprovedMail;
use App\Mail\VacanceRejectedMail;
class VacanceController 
{
    public function index()
{
    $vacances = Vacance::query()
        ->where('admin_status', 'approved') // Only show approved vacations
        ->orderBy('created_at', 'desc')
        ->get();
        $counts = [
            'approved' => Vacance::where('admin_status', 'approved')->count(),
            'rejected' => Vacance::where('admin_status', 'rejected')->count(),
            'pending' => Vacance::where('admin_status', 'pending')->count()
        ];

    return view('home.vacances', compact('vacances'));
}
public function indexx()  
{
    $counts = [
        'approved' => Vacance::where('admin_status', 'approved')->count(),
        'rejected' => Vacance::where('admin_status', 'rejected')->count(),
        'pending' => Vacance::where('admin_status', 'pending')->count()
    ];
    
    $vacances  = Vacance::all();
     // Only get pending properties
     $vacances  = Vacance::where('admin_status', 'pending')->latest()->get();
    return view('laravel-examples.vaconcy-request-management', compact('vacances'));
}
public function approve(Vacance $vacance)
{
    $vacance->update(['admin_status' => 'approved']);
    if ($vacance->user && $vacance->user->email) {
        Mail::to($vacance->user->email)->send(new VacationApprovedMail($vacance));
    }
    return back()->with('success', 'Vacation approved successfully');
}

public function reject(Vacance $vacance)
{
    $vacance->update(['admin_status' => 'rejected']);
     // Send email to user if email exists
     if ($vacance->user && $vacance->user->email) {
        Mail::to($vacance->user->email)->send(new VacanceRejectedMail($vacance));
    }

    return back()->with('success', 'Vacation rejected successfully');
}
    

public function show($id)
{
    $vacance = Vacance::where('admin_status', 'approved')->findOrFail($id);
    
    $similarAnnonces = Vacance::where('type', $vacance->type)
        ->where('wilaya', $vacance->wilaya)
        ->where('id', '!=', $vacance->id)
        ->where('admin_status', 'approved')
        ->limit(4)
        ->get();

    return view('vacance.details', [
        'anoncy' => $vacance,
        'similarAnnonces' => $similarAnnonces
    ]);
}

    public function filtrer(Request $request)
{
    $query = Vacance::query();


    if ($request->filled('wilaya')) {
    $query->where('wilaya', $request->wilaya); // ✅ dynamique selon sélection utilisateur
}


    if ($request->filled('date_arrivee') && $request->filled('date_depart')) {
    $query->where('disponible_de', '<=', $request->date_arrivee)
          ->where('disponible_jusqua', '>=', $request->date_depart);
}


    if ($request->capacite) {
        if ($request->capacite == '1-2') {
            $query->where('capacite', '<=', 2);
        } elseif ($request->capacite == '3-4') {
            $query->whereBetween('capacite', [3, 4]);
        } elseif ($request->capacite == '5+') {
            $query->where('capacite', '>=', 5);
        }
    }

    // Advanced filters
    if ($request->filled('prix_max')) {
        $query->where('prix_nuit', '<=', $request->prix_max);
    }

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

   if ($request->boolean('wifi')) {
    $query->where('wifi', 1);
}
if ($request->boolean('piscine')) {
    $query->where('piscine', 1);
}
if ($request->boolean('parking')) {
    $query->where('parking', 1);
}
if ($request->boolean('climatisation')) {
    $query->where('climatisation', 1);
}



    $vacances = $query->paginate(6);

    return view('home.vacances', compact('vacances'));
}
public function store(Request $request)
{
    try {
        // Validate the request
        $validatedData = $request->validate([
            
            'titre' => 'required|string|max:255',
            'type' => 'required|in:appartement,maison,villa,chalet',
            'description' => 'required|string',
            'localisation' => 'required|string',
            'wilaya' => 'required|string',
            'commune'=> 'required|string',
            'prix_nuit' => 'required|numeric',
            'chambres' => 'required|integer',
            'salles_bain' => 'required|integer',
            'capacite' => 'required|string',
            'superficie' => 'nullable|integer',
            'type_annonce' => 'required|in:location,vente',
            'disponible_de' => 'nullable|date',
            'disponible_jusqua' => 'nullable|date|after_or_equal:disponible_de',
            'statut' => 'required|in:disponible,reserve,loue',
            'main_image' => 'nullable|array',  // Validate it's an array
        'main_image.*' => 'image|mimes:jpg,jpeg,png|max:2048', // Each item must be an image
            'wifi' => 'nullable|boolean',
    'parking' => 'nullable|boolean',
    'piscine' => 'nullable|boolean',
    'cuisine' => 'nullable|boolean',
    'television' => 'nullable|boolean',
    'climatisation' => 'nullable|boolean',
    'eau' => 'nullable|boolean',
    'agency_id' => 'required|exists:agencies,id' ,
        ]);
        $adminStatus = auth('agency')->check() ? 'approved' : 'pending';

 // Handle image uploads
 $imagePaths = [];
 if ($request->hasFile('main_image')) {
     $uploadPath = public_path('images/vacances');
     
     if (!file_exists($uploadPath)) {
         if (!mkdir($uploadPath, 0755, true)) {
             throw new \Exception("Impossible de créer le dossier de stockage");
         }
     }

     foreach ($request->file('main_image') as $image) {
         if (!$image->isValid()) {
             throw new \Exception("Fichier image invalide");
         }

         $imageName = time().'-'.uniqid().'.'.$image->extension();
         if (!$image->move($uploadPath, $imageName)) {
             throw new \Exception("Erreur lors de l'enregistrement de l'image");
         }
         $imagePaths[] = 'images/vacances/'.$imageName;
     }
 }
 $userId = auth('web')->check() ? auth('web')->id() : null;
 if (auth('agency')->check()) {
    $agency = auth('agency')->user();

    if (!$agency->is_premium) {
        $todayCount = \App\Models\Vacance::where('agency_id', $agency->id)
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->count();

        $dailyLimit = $agency->is_pro ? 5 : 2;

        if ($todayCount >= $dailyLimit) {
            return redirect()->route('agence.plan')
                ->with('error', 'Vous avez atteint la limite quotidienne de publications. Veuillez souscrire à un plan pour publier davantage.');
        }
    }
}

 




        // Create the annonce
        $vacance = Vacance::create([
            
            'titre' => $validatedData['titre'],
            'type' => $validatedData['type'],
            'description' => $validatedData['description'],
            'wilaya' => $validatedData['wilaya'],
            'commune' => $validatedData['commune'],
            'localisation' => $validatedData['localisation'],
            'prix_nuit' => $validatedData['prix_nuit'],
            'chambres' => $validatedData['chambres'],
            'salles_bain' => $validatedData['salles_bain'],
            'capacite' => $validatedData['capacite'],
            'superficie' => $validatedData['superficie'] ?? null,
            'type_annonce' => $validatedData['type_annonce'],
            'wifi' => $request->has('wifi'),
    'parking' => $request->has('parking'),
    'piscine' => $request->has('piscine'),
    'cuisine' => $request->has('cuisine'),
    'television' => $request->has('television'),
    'climatisation' => $request->has('climatisation'),
    'eau' => $request->has('eau'),
            'main_image' => !empty($imagePaths) ? json_encode($imagePaths) : null,
            'disponible_de' => $validatedData['disponible_de'] ?? null,
            'disponible_jusqua' => $validatedData['disponible_jusqua'] ?? null,
            'statut' => $validatedData['statut'],
            'agency_id' => $validatedData['agency_id'], 
            'admin_status' => $adminStatus, // Auto-approved for agencies
        'user_id' => $userId, // Add the user_id here
            
        ]);
        return redirect()->back()->with('success', 'Annonce créée avec succès!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput();
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Erreur: '.$e->getMessage())
            ->withInput();
    }

    
}
// Agency dashboard view for managing vacation requests
public function agencyVacances(Request $request)
{
    $query = Vacance::where('agency_id', auth('agency')->id());

    if ($request->filled('status')) {
        $query->where('admin_status', $request->status);
    }

    $vacances = $query->latest()->paginate(10);

    return view('agence.request_vacances', [
        'vacances' => $vacances,
        
    ]);
}
public function indexxxx()
{
    // Get the authenticated agency
    $Vacances = auth('agency')->user();
    
   
    $Vacances = Vacance::where('agency_id', $Vacances->id)
                        
                        ->latest()
                        ->paginate(10);
    
    return view('agence.vacances_Management', compact('Vacances'));
}

         
}