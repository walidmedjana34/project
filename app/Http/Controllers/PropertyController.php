<?php


    

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PropertySubmissionConfirmation;
use App\Mail\PropertyApprovedMail;
use App\Mail\PropertyRejectedMail;
use Carbon\Carbon; // ✅ Correct import
class PropertyController 
{
    public function index()  
{
    $counts = [
        'approved' => Property::where('admin_status', 'approved')->count(),
        'rejected' => Property::where('admin_status', 'rejected')->count(),
        'pending' => Property::where('admin_status', 'pending')->count()
    ];
    
    $properties = Property::all();
     // Only get pending properties
     $properties = Property::where('admin_status', 'pending')->latest()->get();
    return view('laravel-examples.anoncy-request-management', compact('properties'));
}

     // Afficher le formulaire de création
     public function create()
     {
         return view('home.ajouter_annonce');
     }

 public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'wilaya' => 'required|string',
        'commune' => 'required|string',
        'address' => 'required|string',
        'type' => 'required|in:appartement,bungalow,carcasse,villa,immeuble,local,hungar,terrain,bureaux_et_locaux,salle_fetes,garage_parking,chalet,studio,commercial',
        'status' => 'required|in:a_vendre,vendu,a_louer',
        'bedrooms' => 'nullable|integer',
        'bathrooms' => 'nullable|integer',
        'surface' => 'nullable|integer',
        'features' => 'nullable|array',
        'main_image' => 'nullable|array',  // Validate it's an array
        'main_image.*' => 'image|mimes:jpg,jpeg,png|max:2048', // Each item must be an image
        'agency_id' => 'required|exists:agencies,id',
        
    ]);

   // Initialize property data without the image first
   $propertyData = $request->except('main_image');
   // Automatically approve if user is an agency
   // Set admin_status based on who is creating the property
   $propertyData['admin_status'] = auth('agency')->check() ? 'approved' : 'pending';
  // Set user_id if user is authenticated (web guard)
  if ($user = auth('web')->user()) {
    $propertyData['user_id'] = $user->id;
}
  // Handle image uploads
  if ($request->hasFile('main_image')) {
    $imagePaths = [];
    $uploadPath = public_path('images/properties');
    
    // Create directory if it doesn't exist
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0755, true);
    }

    foreach ($request->file('main_image') as $image) {
        if ($image->isValid()) {
            $imageName = time().'-'.uniqid().'.'.$image->extension();
            $image->move($uploadPath, $imageName);
            $imagePaths[] = 'images/properties/'.$imageName;
        }
    }
    
    // Store as JSON encoded array
    $propertyData['main_image'] = json_encode($imagePaths);
}

if (auth('agency')->check()) {
    $agency = auth('agency')->user();

    // PREMIUM : aucune limite
    if (!$agency->is_premium) {
        $todayCount = \App\Models\Property::where('agency_id', $agency->id)
            ->whereDate('created_at', Carbon::today())
            ->count();

        $dailyLimit = $agency->is_pro ? 5 : 2;

        if ($todayCount >= $dailyLimit) {
            return redirect()->route('agence.plan')
                ->with('error', 'Vous avez atteint la limite quotidienne de publications. Veuillez souscrire à un plan pour publier davantage.');
        }
    }
}

   // Create the property ONCE with all data
   $property = Property::create($propertyData);
   if (auth('web')->check()) {
    $user = auth('web')->user();
    Mail::to($user->email)->send(new PropertySubmissionConfirmation($user));
}





   return redirect()->route('home.annonces')->with('success', 'Annonce créée avec succès!');
}


    public function show(Property $property)
    {
        return response()->json($property);
    }

    public function update(Request $request, Property $property)
    {
        $property->update($request->all());
        return response()->json(['message' => 'Property updated successfully!', 'property' => $property]);
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['message' => 'Property deleted successfully!']);
    }
    public function approve(Property $property)
{
    $property->update(['admin_status' => 'approved']);

    if ($property->user && $property->user->email) {
        Mail::to($property->user->email)->send(new PropertyApprovedMail($property));
    }

    return back()->with('success', 'Annonce approuvée avec succès et email envoyé.');
}
    
    public function reject(Property $property)
    {
        // Check if the property belongs to the agency
    if ($property->agency_id != auth('agency')->id()) {
        return back()->with('error', 'Unauthorized action');
    }

        // Update the agency status to rejected
        $property->update(['admin_status' => 'rejected']);
        if ($property->user && $property->user->email) {
            Mail::to($property->user->email)->send(new PropertyRejectedMail($property));
        }
    
        // Redirect back with success message
        return back()->with('success', 'Property rejetée avec succès');
    }
    public function indexx(Request $request)
    { 
        $query = Property::with('agency') // Charger l'agence
        ->whereHas('agency', function($q) {
            $q->where('admin_status', 'approved'); // agence approuvée
        });
    // Counts for the dashboard cards
    $approvedCount = Property::where('status', 'approved')->count();
    $rejectedCount = Property::where('status', 'rejected')->count();
    $pendingCount = Property::where('status', 'pending')->count();
    // Apply search term
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
    $q->where('properties.title', 'like', "%$searchTerm%")
      ->orWhere('properties.description', 'like', "%$searchTerm%")
      ->orWhere('properties.address', 'like', "%$searchTerm%")
      ->orWhere('properties.commune', 'like', "%$searchTerm%")
      ->orWhere('properties.wilaya', 'like', "%$searchTerm%");
});
    }
       
       
    
        if ($request->filled('property_type')) {
            $query->where('type', $request->property_type);
        }
    
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
    
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    
        if ($request->filled('wilaya')) {
    $query->where('properties.wilaya', $request->wilaya); // ✅ تحديد الجدول
}
    
        if ($request->filled('commune')) {
    $query->where('properties.commune', $request->commune);
}
    
       // Join avec la table des agences pour trier par is_premium
$query->leftJoin('agencies', 'properties.agency_id', '=', 'agencies.id')
      ->orderByDesc('agencies.is_premium') // Priorité aux agences premium
      ->orderByDesc('properties.created_at') // Ensuite les plus récentes
      ->select('properties.*'); // Obligatoire pour éviter les colonnes dupliquées

    
        $annonces = $query->get();
        
        // Get wilayas and communes for dropdowns
        $wilayas = config('wilayas');
        $communes = config('communes');
    
        return view('home.annonces', compact('annonces', 'wilayas', 'communes'));
    }
    public function detaille($id)
    {
        $anoncy = Property::with('agency')->findOrFail($id);
        
        // Get similar properties (same type and status, excluding current one)
        $similarAnnonces = Property::where('type', $anoncy->type)
                                ->where('status', $anoncy->status)
                                ->where('id', '!=', $id)
                                ->where('admin_status', 'approved') // only show approved properties
                                ->limit(3)
                                ->get();
        
        return view('home.details', compact('anoncy', 'similarAnnonces'));
    }
// In PropertyController.php

public function agencyRequests(Request $request)
{
    // Start with base query for this agency's properties
    $query = Property::where('agency_id', auth('agency')->id());
    
    // Apply status filter if provided
    if ($request->filled('status')) {
        $query->where('admin_status', $request->status);
    }
    
   
    
    $properties = $query->latest()->get();
    
    $counts = [
        'approved' => Property::where('agency_id', auth('agency')->id())
                             ->where('admin_status', 'approved')
                             ->count(),
        'rejected' => Property::where('agency_id', auth('agency')->id())
                             ->where('admin_status', 'rejected')
                             ->count(),
        'pending' => Property::where('agency_id', auth('agency')->id())
                           ->where('admin_status', 'pending')
                           ->count(),
    ];

    return view('agence.request', compact('properties', 'counts'));
}
public function indexxxx()
{
    // Get the authenticated agency
    $properties = auth('agency')->user();
    
   
    $properties = Property::where('agency_id', $properties->id)
                        
                        ->latest()
                        ->paginate(10);
    
    return view('agence.Properties_Management', compact('properties'));
}
}



   


 