<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Entretien;
use App\Enums\StatutCandidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Statistiques globales
        $stats = [
            'total' => $user->candidatures()->count(),
            'entretiens_planifies' => Entretien::whereHas('candidature', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->upcoming()->count(),
            'offres_recues' => $user->candidatures()->byStatut(StatutCandidature::OffreRecue->value)->count(),
            'archives' => $user->candidatures()->onlyTrashed()->count(),
        ];

        // 5 dernières candidatures
        $recentes = $user->candidatures()
            ->with('entretiens')
            ->latest()
            ->take(5)
            ->get();

        // 5 prochains entretiens
        $prochainsEntretiens = Entretien::with('candidature')
            ->whereHas('candidature', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->upcoming()
            ->orderBy('date_heure')
            ->take(5)
            ->get();

        // Répartition des candidatures par statut
        $parStatut = $user->candidatures()
            ->select('statut', DB::raw('count(*) as total'))
            ->groupBy('statut')
            ->pluck('total', 'statut');

        return view('dashboard', compact('stats', 'recentes', 'prochainsEntretiens', 'parStatut'));
    }
}
