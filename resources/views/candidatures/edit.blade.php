@extends('layouts.app')

@section('title', 'Modifier ' . $candidature->entreprise)
@section('page-title', 'Édition de candidature')

@section('page-actions')
    <a href="{{ route('candidatures.show', $candidature) }}" class="btn-secondary">Annuler</a>
@endsection

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="card p-8 md:p-12">
        <div class="mb-10">
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-2">Modifier la candidature</h2>
            <p class="text-gray-500 text-sm">Mettez à jour les informations pour <strong>{{ $candidature->entreprise }}</strong>.</p>
        </div>

        <form method="POST" action="{{ route('candidatures.update', $candidature) }}" enctype="multipart/form-data"
              class="space-y-10">
            @csrf
            @method('PUT')

            @include('candidatures._form')

            <div class="flex items-center gap-4 pt-8 border-t border-gray-100">
                <button type="submit" class="btn-primary px-8">
                    💾 Sauvegarder les modifications
                </button>
                <a href="{{ route('candidatures.show', $candidature) }}" class="btn-ghost">Abandonner</a>
            </div>
        </form>
    </div>
</div>

@endsection
