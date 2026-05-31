<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Entretien;
use App\Enums\StatutCandidature;
use App\Enums\ResultatEntretien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatistiquesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Taux de conversion
        $total = $user->candidatures()->count();
        $withInterviews = $user->candidatures()->has('entretiens')->count();
        $offers = $user->candidatures()->byStatut(StatutCandidature::OffreRecue->value)->count();

        $conversion = [
            'interviews' => $total > 0 ? round(($withInterviews / $total) * 100, 1) : 0,
            'offers' => $total > 0 ? round(($offers / $total) * 100, 1) : 0,
        ];

        // 2. Évolution mensuelle (6 derniers mois)
        $evolution = $user->candidatures()
            ->select(DB::raw("DATE_FORMAT(date_candidature, '%Y-%m') as month"), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get()
            ->reverse();

        // 3. Répartition par priorité
        $parPriorite = $user->candidatures()
            ->select('priorite', DB::raw('count(*) as total'))
            ->groupBy('priorite')
            ->pluck('total', 'priorite');

        // 4. Résultats des entretiens
        $resultatsEntretiens = Entretien::whereHas('candidature', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->select('resultat', DB::raw('count(*) as total'))
            ->groupBy('resultat')
            ->pluck('total', 'resultat');

        return view('statistiques', compact('conversion', 'evolution', 'parPriorite', 'resultatsEntretiens', 'total', 'withInterviews', 'offers'));
    }
}
