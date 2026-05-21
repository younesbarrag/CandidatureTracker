@extends('layouts.app')

@section('title', 'Nouveau rendez-vous')
@section('page-title', 'Programmer un entretien')

@section('page-actions')
    <a href="{{ route('candidatures.show', $candidature) }}" class="btn-secondary">Annuler</a>
@endsection

@section('content')

<div class="max-w-2xl mx-auto">
    {{-- Contexte candidature --}}
    <div class="mb-6 flex items-center gap-3 text-sm font-medium">
        <a href="{{ route('candidatures.show', $candidature) }}" class="text-brand-600 hover:text-brand-700 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            {{ $candidature->entreprise }}
        </a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-500">{{ $candidature->poste }}</span>
    </div>

    <div class="card p-8 md:p-10">
        <div class="mb-10 flex items-center gap-4">
            <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center border border-brand-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Ajouter un entretien</h2>
                <p class="text-gray-500 text-sm">Précisez les détails du rendez-vous.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('entretiens.store', $candidature) }}" class="space-y-8">
            @csrf

            @include('entretiens._form', ['entretien' => null])

            <div class="flex items-center gap-4 pt-8 border-t border-gray-100">
                <button type="submit" class="btn-primary px-8">
                    📅 Enregistrer le rendez-vous
                </button>
                <a href="{{ route('candidatures.show', $candidature) }}" class="btn-ghost">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
