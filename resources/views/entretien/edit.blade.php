@extends('layouts.app')

@section('title', 'Modifier l\'entretien')
@section('page-title', 'Modifier l\'entretien')

@section('content')

<div class="max-w-xl mx-auto">
    <div class="mb-4 flex items-center gap-3 text-sm text-gray-500">
        <a href="{{ route('candidatures.show', $entretien->candidature) }}"
           class="text-brand-600 hover:underline font-medium">
            ← {{ $entretien->candidature->entreprise }}
        </a>
        <span>·</span>
        <span>{{ $entretien->candidature->poste }}</span>
    </div>

    <div class="card p-8">
        <form method="POST" action="{{ route('entretiens.update', $entretien) }}"
              class="space-y-5">
            @csrf
            @method('PUT')

            @include('entretiens._form')

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">💾 Mettre à jour</button>
                <a href="{{ route('candidatures.show', $entretien->candidature) }}" class="btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
