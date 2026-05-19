<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Entretien;
use App\Http\Requests\StoreEntretienRequest;
use App\Http\Requests\UpdateEntretienRequest;
use Illuminate\Http\Request;    


class EntretienController extends Controller
{
    /**
     * CREATE
     */
    public function create(Candidature $candidature)
    {
        $this->authorize('view', $candidature);

        return view('entretiens.create', [
            'candidature' => $candidature,
            'types' => $this->types(),
            'resultats' => $this->resultats(),
        ]);
    }

    /**
     * STORE
     */
    public function store(StoreEntretienRequest $request, Candidature $candidature)
    {
        $this->authorize('update', $candidature);

        $candidature->entretiens()->create($request->validated());

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Entretien ajouté');
    }

    /**
     * EDIT
     */
    public function edit(Entretien $entretien)
    {
        $this->authorize('update', $entretien->candidature);

        return view('entretiens.edit', [
            'entretien' => $entretien,
            'candidature' => $entretien->candidature,
            'types' => $this->types(),
            'resultats' => $this->resultats(),
        ]);
    }

    /**
     * UPDATE
     */
    public function update(UpdateEntretienRequest $request, Entretien $entretien)
    {
        $this->authorize('update', $entretien->candidature);

        $entretien->update($request->validated());

        return redirect()
            ->route('candidatures.show', $entretien->candidature)
            ->with('success', 'Entretien mis à jour');
    }

    /**
     * DELETE
     */
    public function destroy(Entretien $entretien)
    {
        $this->authorize('delete', $entretien->candidature);

        $candidature = $entretien->candidature;

        $entretien->delete();

        return redirect()
            ->route('candidatures.show', $candidature)
            ->with('success', 'Entretien supprimé');
    }

    /**
     * HELPERS (clean version)
     */

    private function types()
    {
        return [
            'telephone' => 'Téléphone',
            'visio' => 'Vidéo',
            'presentiel' => 'Présentiel',
            'technique' => 'Test technique',
            'rh' => 'RH',
        ];
    }

    private function resultats()
    {
        return [
            'en_attente' => 'En attente',
            'positif' => 'Positif',
            'negatif' => 'Négatif',
            'sans_suite' => 'Sans suite',
        ];
    }
}