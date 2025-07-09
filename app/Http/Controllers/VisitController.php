<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Visit;         // Import the Visit model
use Illuminate\Support\Facades\Auth; // Optional, in case you use Auth::id()
use App\Models\Property;
use App\Mail\VisitConfirmed;
use Illuminate\Support\Facades\Mail;
use App\Mail\VisitRefused;
class VisitController

{
    public function index(Request $request)
    {
        $agencyId = auth()->guard('agency')->id();
        
        $visits = Visit::with(['property', 'user'])
            ->where('agency_id', $agencyId)
            ->when($request->has('status'), function($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('scheduled_date', $request->sort === 'oldest' ? 'asc' : 'desc')
            ->paginate(10);

        return view('agence.visite_agence', compact('visits'));
    }

    public function updateStatus(Request $request, Visit $visit)
{
    $request->validate([
        'status' => 'required|in:pending,confirmed,completed,canceled'
    ]);

    // Vérification plus robuste de l'agence
    if ($visit->agency_id != auth()->guard('agency')->id()) {
        return response()->json([
            'success' => false,
            'message' => 'Action non autorisée'
        ], 403);
    }

     try {
        $visit->update(['status' => $request->status]);

        // Envoi de l'e-mail selon le statut
        if ($visit->user && $visit->user->email) {
            if ($request->status === 'confirmed') {
                Mail::to($visit->user->email)->send(new VisitConfirmed($visit));
            } elseif ($request->status === 'canceled') {
                Mail::to($visit->user->email)->send(new VisitRefused($visit));
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour avec succès'
        ]);
    } catch (\Exception $e) {
        \Log::error('Erreur email statut visite : ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la mise à jour'
        ], 500);
    }
}

    public function reschedule(Request $request, Visit $visit)
    {
        // Vérifier que l'agence peut modifier cette visite
    if ($visit->agency_id != auth()->guard('agency')->id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }
        $request->validate([
            'scheduled_date' => 'required|date|after:now',
            'scheduled_time' => 'required',
        ]);

        $scheduledDateTime = Carbon::parse($request->scheduled_date . ' ' . $request->scheduled_time);
        
        $visit->update(['scheduled_date' => $scheduledDateTime]);

        return response()->json(['success' => true]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vacance_id' => 'required_without:property_id|exists:vacances,id',
        'property_id' => 'required_without:vacance_id|exists:properties,id',
            'scheduled_date' => 'required|date|after:now',
            'scheduled_time' => 'required',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        // Combine date and time
        $scheduledDateTime = $validated['scheduled_date'] . ' ' . $validated['scheduled_time'];

        
     
        $visit = Visit::create([
            'user_id' => auth('web')->id(), // assuming 'web' is the user guard // or null if not logged in
            'property_id' => $validated['property_id'] ?? null,
        'vacance_id' => $validated['vacance_id'] ?? null,
            'agency_id' => $request->agency_id, // Make sure to pass this from the form
            'scheduled_date' => $scheduledDateTime,
            'phone' => $validated['phone'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);
        return back()->with('success', 'Votre demande de visite a été enregistrée. L\'agent vous contactera pour confirmation.');
    }
    public function clientVisits(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        $visits = Visit::with(['property', 'agency'])
            ->where('user_id', $user->id)
            ->when($request->has('status'), function($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('scheduled_date', $request->sort === 'oldest' ? 'asc' : 'desc')
            ->get();

        // Séparation des visites à venir et passées
        $upcomingVisits = $visits->where('scheduled_date', '>=', now())
            ->where('status', '!=', 'canceled');
        
        $pastVisits = $visits->filter(function($visit) {
            return $visit->scheduled_date < now() || $visit->status === 'canceled';
        });

        return view('dashboard_client', [
            'user' => $user,
            'upcomingVisits' => $upcomingVisits,
            'pastVisits' => $pastVisits
        ]);
    }
    public function clientCancelVisit(Request $request, Visit $visit)
    {
        // Vérification que le client peut annuler cette visite
        if ($visit->user_id != Auth::guard('web')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Action non autorisée'
            ], 403);
        }

        // Vérification que la visite peut être annulée
        if ($visit->scheduled_date < now() || $visit->status === 'canceled') {
            return response()->json([
                'success' => false,
                'message' => 'Cette visite ne peut plus être annulée'
            ], 400);
        }

        try {
            $visit->update(['status' => 'canceled']);
            
            return response()->json([
                'success' => true,
                'message' => 'Visite annulée avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'annulation'
            ], 500);
        }
    }

    // ... Vos autres méthodes existantes ...

}
