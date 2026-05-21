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
<form method="GET" action="{{ route('candidatures.index') }}" class="mb-8">
    <div class="card p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">

            {{-- Recherche --}}
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Recherche</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Entreprise, poste..."
                           class="input pl-10">
                </div>
            </div>

            {{-- Filtre statut --}}
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Statut</label>
                <select name="statut" class="input">
                    <option value="">Tous les statuts</option>
                    @foreach($statuts as $value => $label)
                        <option value="{{ $value }}" {{ request('statut') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Boutons d'action --}}
            <div class="flex gap-2">
                <button type="submit" class="btn-primary flex-1 justify-center">
                    Filtrer
                </button>

                @if(request()->hasAny(['search', 'statut', 'priorite']))
                    <a href="{{ route('candidatures.index') }}" class="btn-secondary" title="Réinitialiser">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</form>

{{-- ── Liste des candidatures ────────────────────────────────────────────── --}}
@forelse($candidatures as $candidature)
    @if($loop->first)
    <div class="card overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Entreprise & Poste</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Statut</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Priorité</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Dernière activité</th>
                    <th class="px-6 py-4 text-right"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
    @endif

                <tr class="table-row group">
                    <td class="px-6 py-5">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-900 group-hover:text-brand-600 transition-colors">{{ $candidature->entreprise }}</span>
                            <span class="text-gray-500 text-xs">{{ $candidature->poste }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="badge {{ $candidature->statut_badge }}">
                            {{ $candidature->statut_label }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <span class="badge {{ $candidature->priorite_badge }}">
                            {{ $candidature->priorite_label }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col">
                            <span class="text-gray-700 font-medium">{{ $candidature->date_candidature->format('d M Y') }}</span>
                            <span class="text-gray-400 text-[10px] uppercase tracking-tighter">Candidature envoyée</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2 justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('candidatures.show', $candidature) }}" class="btn-ghost btn-sm" title="Voir">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('candidatures.edit', $candidature) }}" class="btn-ghost btn-sm" title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>

    @if($loop->last)
            </tbody>
        </table>
    </div>
    @endif

@empty
    <div class="card p-20 text-center">
        <div class="w-20 h-20 bg-brand-50 text-brand-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune candidature</h3>
        <p class="text-gray-500 mb-8 max-w-sm mx-auto">
            Commencez à suivre vos opportunités professionnelles dès maintenant en ajoutant votre première candidature.
        </p>
        <a href="{{ route('candidatures.create') }}" class="btn-primary">
            + Créer une candidature
        </a>
    </div>
@endforelse

@if($candidatures->hasPages())
    <div class="mt-8">
        {{ $candidatures->links() }}
    </div>
@endif

@endsection
