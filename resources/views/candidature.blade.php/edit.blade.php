@extends('layouts.app')

@section('title', 'Modifier — ' . $candidature->entreprise)
@section('page-title', 'Modifier la candidature')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="card p-8">
        <div class="mb-6 pb-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">{{ $candidature->entreprise }}</h2>
            <p class="text-gray-500 text-sm">{{ $candidature->poste }}</p>
        </div>

        {{-- enctype obligatoire pour l'upload de fichier --}}
        <form method="POST" action="{{ route('candidatures.update', $candidature) }}"
              enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            @include('candidatures._form')

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    💾 Sauvegarder
                </button>
                <a href="{{ route('candidatures.show', $candidature) }}" class="btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
