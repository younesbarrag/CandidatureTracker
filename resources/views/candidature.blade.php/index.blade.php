@extends('layouts.app')

@section('title', 'Mes candidatures')
@section('page-title', 'Mes candidatures')

@section('page-actions')
    <a href="{{ route('candidatures.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvelle candidature
    </a>
@endsection

@section('content')

{{-- ── Barre de filtres ────────────────────────────────────────────────────── --}}
<form method="GET" action="{{ route('candidatures.index') }}" class="mb-6">
    <div class="card p-4">
        <div class="flex flex-wrap gap-3 items-end">

            {{-- Recherche --}}
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Recherche</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Entreprise ou poste…"
                       class="input">
            </div>

            {{-- Filtre statut --}}
            <div class="min-w-[180px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Statut</label>
                <select name="statut" class="input">
                    <option value="">Tous les statuts</option>
                    @foreach($statuts as $value => $label)
                        <option value="{{ $value }}" {{ request('statut') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filtre priorité --}}
            <div class="min-w-[150px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Priorité</label>
                <select name="priorite" class="input">
                    <option value="">Toutes priorités</option>
                    @foreach($priorites as $value => $label)
                        <option value="{{ $value }}" {{ request('priorite') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
                Filtrer
            </button>

            @if(request()->hasAny(['search', 'statut', 'priorite']))
                <a href="{{ route('candidatures.index') }}" class="btn-secondary">Réinitialiser</a>
            @endif
        </div>
    </div>
</form>

{{-- ── Résultats : @forelse gère le cas vide ──────────────────────────────── --}}
@forelse($candidatures as $candidature)
    @if($loop->first)
    <div class="card">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Entreprise</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Poste</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Statut</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Priorité</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Entretiens</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Date</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody>
    @endif

                <tr class="table-row">
                    <td class="px-5 py-4">
                        <div class="font-semibold text-gray-900">{{ $candidature->entreprise }}</div>
                        @if($candidature->url_offre)
                            <a href="{{ $candidature->url_offre }}" target="_blank"
                               class="text-xs text-brand-600 hover:underline">Voir l'offre →</a>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-gray-700">{{ $candidature->poste }}</td>
                    <td class="px-5 py-4">
                        <span class="badge {{ $candidature->statut_badge }}">
                            {{ $candidature->statut_label }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="badge {{ $candidature->priorite_badge }}">
                            {{ $candidature->priorite_label }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        @if($candidature->entretiens->count() > 0)
                            <span class="inline-flex items-center gap-1 text-gray-700">
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $candidature->entretiens->count() }}
                            </span>
                        @else
                            <span class="text-gray-400 text-xs">Aucun</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-gray-500 text-xs">
                        {{ $candidature->date_candidature->format('d/m/Y') }}
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2 justify-end">
                            <a href="{{ route('candidatures.show', $candidature) }}" class="btn-ghost btn-sm">Voir</a>
                            <a href="{{ route('candidatures.edit', $candidature) }}" class="btn-secondary btn-sm">Éditer</a>
                            <form method="POST" action="{{ route('candidatures.destroy', $candidature) }}"
                                  onsubmit="return confirm('Archiver cette candidature ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost btn-sm text-red-500 hover:bg-red-50">Archiver</button>
                            </form>
                        </div>
                    </td>
                </tr>

    @if($loop->last)
            </tbody>
        </table>
    </div>
    @endif

@empty
    {{-- Cas vide géré avec @forelse --}}
    <div class="card p-16 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucune candidature trouvée</h3>
        <p class="text-gray-500 mb-6">
            @if(request()->hasAny(['search', 'statut', 'priorite']))
                Aucun résultat pour ces filtres. Essayez de les modifier.
            @else
                Vous n'avez pas encore créé de candidature.
            @endif
        </p>
        <a href="{{ route('candidatures.create') }}" class="btn-primary">
            Créer ma première candidature
        </a>
    </div>
@endforelse

{{-- ── Pagination ──────────────────────────────────────────────────────────── --}}
@if($candidatures->hasPages())
    <div class="mt-6">
        {{ $candidatures->links() }}
    </div>
@endif

@endsection
