@extends('layouts.app')

@section('title', $candidature->entreprise . ' — ' . $candidature->poste)
@section('page-title', $candidature->entreprise)

@section('page-actions')
    <a href="{{ route('candidatures.edit', $candidature) }}" class="btn-secondary">✏️ Modifier</a>
    <a href="{{ route('entretiens.create', $candidature) }}" class="btn-primary">+ Entretien</a>
@endsection

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ── Colonne principale ──────────────────────────────────────────── --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Infos candidature --}}
        <div class="card p-6">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $candidature->poste }}</h2>
                    <p class="text-gray-500 mt-1">{{ $candidature->entreprise }}</p>
                </div>
                <div class="flex gap-2 flex-wrap justify-end">
                    <span class="badge {{ $candidature->statut_badge }}">{{ $candidature->statut_label }}</span>
                    <span class="badge {{ $candidature->priorite_badge }}">{{ $candidature->priorite_label }}</span>
                </div>
            </div>

            <dl class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-gray-400 font-medium mb-1">Date de candidature</dt>
                    <dd class="text-gray-900 font-semibold">{{ $candidature->date_candidature->format('d/m/Y') }}</dd>
                </div>
                @if($candidature->url_offre)
                <div>
                    <dt class="text-gray-400 font-medium mb-1">Offre d'emploi</dt>
                    <dd>
                        <a href="{{ $candidature->url_offre }}" target="_blank"
                           class="text-brand-600 hover:underline truncate block">
                            Voir l'offre →
                        </a>
                    </dd>
                </div>
                @endif
            </dl>

            @if($candidature->notes)
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Notes</h3>
                    <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $candidature->notes }}</p>
                </div>
            @endif

            {{-- Fichier attaché --}}
            @if($candidature->fichier)
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Document joint</h3>
                    <a href="{{ route('candidatures.download', $candidature) }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Télécharger le fichier
                    </a>
                </div>
            @endif
        </div>

        {{-- ── Entretiens ─────────────────────────────────────────────── --}}
        <div class="card">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">
                    Entretiens
                    <span class="ml-2 bg-gray-100 text-gray-600 text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ $candidature->entretiens->count() }}
                    </span>
                </h3>
                <a href="{{ route('entretiens.create', $candidature) }}" class="btn-primary btn-sm">
                    + Ajouter
                </a>
            </div>

            @forelse($candidature->entretiens as $entretien)
                <div class="px-6 py-4 border-b border-gray-50 last:border-0 flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <span class="font-medium text-gray-900 text-sm">{{ $entretien->type_label }}</span>
                            <span class="badge {{ $entretien->resultat_badge }}">{{ $entretien->resultat_label }}</span>
                        </div>
                        <p class="text-xs text-gray-500">
                            📅 {{ $entretien->date_heure->format('d/m/Y à H:i') }}
                        </p>
                        @if($entretien->notes_preparation)
                            <p class="mt-2 text-xs text-gray-600 bg-gray-50 rounded-lg px-3 py-2 leading-relaxed">
                                {{ $entretien->notes_preparation }}
                            </p>
                        @endif
                    </div>
                    <div class="flex items-center gap-1 flex-shrink-0">
                        <a href="{{ route('entretiens.edit', $entretien) }}" class="btn-ghost btn-sm">Éditer</a>
                        <form method="POST" action="{{ route('entretiens.destroy', $entretien) }}"
                              onsubmit="return confirm('Supprimer cet entretien ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-ghost btn-sm text-red-500 hover:bg-red-50">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="px-6 py-10 text-center">
                    <p class="text-gray-400 text-sm">Aucun entretien enregistré.</p>
                    <a href="{{ route('entretiens.create', $candidature) }}" class="mt-3 btn-primary btn-sm inline-flex">
                        Ajouter le premier entretien
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ── Colonne latérale ────────────────────────────────────────────── --}}
    <div class="space-y-4">

        {{-- Actions --}}
        <div class="card p-5 space-y-2">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Actions</h3>
            <a href="{{ route('candidatures.edit', $candidature) }}"
               class="w-full btn-secondary justify-center">
                ✏️ Modifier la candidature
            </a>
            <a href="{{ route('entretiens.create', $candidature) }}"
               class="w-full btn-primary justify-center">
                📅 Ajouter un entretien
            </a>
            <div class="pt-2 border-t border-gray-100 mt-2">
                <form method="POST" action="{{ route('candidatures.destroy', $candidature) }}"
                      onsubmit="return confirm('Archiver cette candidature ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full btn btn-sm text-red-500 hover:bg-red-50 justify-center">
                        📁 Archiver
                    </button>
                </form>
            </div>
        </div>

        {{-- Métadonnées --}}
        <div class="card p-5">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Informations</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt class="text-gray-500">Créée le</dt>
                    <dd class="text-gray-900 font-medium">{{ $candidature->created_at->format('d/m/Y') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Modifiée le</dt>
                    <dd class="text-gray-900 font-medium">{{ $candidature->updated_at->format('d/m/Y') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Entretiens</dt>
                    <dd class="text-gray-900 font-medium">{{ $candidature->entretiens->count() }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>

@endsection
