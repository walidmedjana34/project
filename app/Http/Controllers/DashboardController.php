<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Visit;
use App\Models\Message;
use Carbon\Carbon;

class DashboardController 
{
    public function userDashboard()
{
    return view('dashboard');
}

    public function index()
    {
        $agency = auth('agency')->user();
        
        // Statistiques principales
        $stats = [
            'total_properties' => Property::where('agency_id', $agency->id)->count(),
            'pending_visits' => Visit::where('agency_id', $agency->id)
                                    ->where('status', 'pending')
                                    ->count(),
            'unread_messages' => Message::where('agency_id', $agency->id)
                                    ->where('read_status', false)
                                    ->count(),
            'monthly_revenue' => $agency->monthly_revenue // Supposons que ce champ existe
        ];

        // Données pour les graphiques (30 derniers jours)
        $viewsData = $this->getViewsData($agency->id);
        $conversionData = $this->getConversionData($agency->id);

        // Visites à venir
        $upcomingVisits = Visit::with(['property', 'user'])
                            ->where('agency_id', $agency->id)
                            ->where('status', '!=', 'canceled')
                            ->where('scheduled_date', '>=', now())
                            ->orderBy('scheduled_date', 'asc')
                            ->limit(3)
                            ->get();

        // Messages récents
        $recentMessages = Message::with(['sender', 'property'])
    ->where('agency_id', $agency->id)
    ->orderBy('created_at', 'desc')
    ->limit(3)
    ->get();


        return view('agence.agency_Dashboard', compact(
            'stats', 
            'viewsData',
            'conversionData',
            'upcomingVisits',
            'recentMessages',
            'agency'
        ));
    }

    private function getViewsData($agencyId)
    {
        // Implémentez la logique pour récupérer les vues de propriétés
        return [
            'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            'data' => [12, 19, 3, 5]
        ];
    }

    private function getConversionData($agencyId)
    {
        // Implémentez la logique pour le taux de conversion
        return [
            'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            'data' => [25, 30, 18, 42]
        ];
    }
}