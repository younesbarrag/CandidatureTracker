<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Http\Requests\Candidature\StoreCandidatureRequest;
use App\Http\Requests\Candidature\UpdateCandidatureRequest;
use App\Enums\StatutCandidature;
use App\Enums\PrioriteCandidature;
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
            'statuts' => StatutCandidature::options(),
            'priorites' => PrioriteCandidature::options(),
        ]);
    }

    /**
     * CREATE FORM
     */
    public function create()
    {
        return view('candidatures.create', [
            'statuts' => StatutCandidature::options(),
            'priorites' => PrioriteCandidature::options(),
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
            $candidature->update(['cv_path' => $path]);
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
            'statuts' => StatutCandidature::options(),
            'priorites' => PrioriteCandidature::options(),
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

            if ($candidature->cv_path) {
                Storage::disk('public')->delete($candidature->cv_path);
            }

            $path = $request->file('fichier')->store('candidatures', 'public');
            $candidature->update(['cv_path' => $path]);
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
     * DOWNLOAD
     */
    public function download(Candidature $candidature)
    {
        $this->authorize('view', $candidature);

        if (!$candidature->cv_path || !Storage::disk('public')->exists($candidature->cv_path)) {
            return back()->with('error', 'Le fichier n\'existe pas.');
        }

        return Storage::disk('public')->download($candidature->cv_path);
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
}
