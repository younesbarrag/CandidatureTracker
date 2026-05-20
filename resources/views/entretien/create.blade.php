@extends('layouts.app')

@section('title', 'Ajouter un entretien')
@section('page-title', 'Ajouter un entretien')

@section('content')

<div class="max-w-xl mx-auto">
    {{-- Contexte candidature --}}
    <div class="mb-4 flex items-center gap-3 text-sm text-gray-500">
        <a href="{{ route('candidatures.show', $candidature) }}"
           class="text-brand-600 hover:underline font-medium">
            ← {{ $candidature->entreprise }}
        </a>
        <span>·</span>
        <span>{{ $candidature->poste }}</span>
    </div>

    <div class="card p-8">
        <form method="POST" action="{{ route('entretiens.store', $candidature) }}"
              class="space-y-5">
            @csrf

            @include('entretiens._form', ['entretien' => null])

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">📅 Enregistrer l'entretien</button>
                <a href="{{ route('candidatures.show', $candidature) }}" class="btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
