<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CandidatureController extends Controller
{
    /**
     * LIST
     */
    public function index(Request $request)
    {
        $query = $request->user()
            ->candidatures()
            ->with('entretiens')
            ->latest();

        // Filters
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('priorite')) {
            $query->where('priorite', $request->priorite);
        }

        $candidatures = $query->paginate(10);

        return view('candidatures.index', [
            'candidatures' => $candidatures,
            'statuts' => $this->getStatutsList(),
            'priorites' => $this->getPrioritesList(),
        ]);
    }

    /**
     * CREATE FORM
     */
    public function create()
    {
        return view('candidatures.create', [
            'statuts' => $this->getStatutsList(),
            'priorites' => $this->getPrioritesList(),
        ]);
    }

    /**
     * STORE
     */
    public function store(StoreCandidatureRequest $request)
    {
        $candidature = $request->user()
            ->candidatures()
            ->create($request->validated());

        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('candidatures', 'public');
            $candidature->update(['fichier' => $path]);
        }

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Candidature créée avec succès');
    }

    /**
     * SHOW
     */
    public function show(Candidature $candidature)
    {
        $this->authorize('view', $candidature);

        $candidature->load('entretiens');

        return view('candidatures.show', compact('candidature'));
    }

    /**
     * EDIT
     */
    public function edit(Candidature $candidature)
    {
        $this->authorize('update', $candidature);

        return view('candidatures.edit', [
            'candidature' => $candidature,
            'statuts' => $this->getStatutsList(),
            'priorites' => $this->getPrioritesList(),
        ]);
    }

    /**
     * UPDATE
     */
    public function update(UpdateCandidatureRequest $request, Candidature $candidature)
    {
        $this->authorize('update', $candidature);

        $candidature->update($request->validated());

        if ($request->hasFile('fichier')) {

            if ($candidature->fichier) {
                Storage::disk('public')->delete($candidature->fichier);
            }

            $path = $request->file('fichier')->store('candidatures', 'public');
            $candidature->update(['fichier' => $path]);
        }

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Candidature mise à jour');
    }

    /**
     * DELETE (SOFT DELETE)
     */
    public function destroy(Candidature $candidature)
    {
        $this->authorize('delete', $candidature);

        $candidature->delete();

        return redirect()
            ->route('candidatures.index')
            ->with('success', 'Candidature archivée');
    }

    /**
     * ARCHIVES
     */
    public function archives(Request $request)
    {
        $candidatures = $request->user()
            ->candidatures()
            ->onlyTrashed()
            ->with('entretiens')
            ->latest('deleted_at')
            ->paginate(10);

        return view('candidatures.archives', compact('candidatures'));
    }

    /**
     * RESTORE
     */
    public function restore($id, Request $request)
    {
        $candidature = Candidature::withTrashed()->findOrFail($id);

        $this->authorize('restore', $candidature);

        if ($candidature->user_id !== $request->user()->id) {
            abort(403);
        }

        $candidature->restore();

        return back()->with('success', 'Candidature restaurée');
    }

    /**
     * HELPERS
     */
    private function getStatutsList()
    {
        return [
            'candidature_envoyee' => 'Candidature envoyée',
            'en_attente' => 'En attente',
            'entretien_planifie' => 'Entretien planifié',
            'offre_recue' => 'Offre reçue',
            'refusee' => 'Refusée',
            'abandonnee' => 'Abandonnée',
        ];
    }

    private function getPrioritesList()
    {
        return [
            'haute' => ' Haute',
            'moyenne' => ' Moyenne',
            'basse' => ' Basse',
        ];
    }
}