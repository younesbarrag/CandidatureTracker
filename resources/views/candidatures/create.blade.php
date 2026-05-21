@extends('layouts.app')

@section('title', 'Nouvelle candidature')
@section('page-title', 'Ajouter une opportunité')

@section('page-actions')
    <a href="{{ route('candidatures.index') }}" class="btn-secondary">Annuler</a>
@endsection

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="card p-8 md:p-12">
        <div class="mb-10">
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-2">Nouvelle candidature</h2>
            <p class="text-gray-500 text-sm">Remplissez les détails du poste pour commencer le suivi.</p>
        </div>

        <form method="POST" action="{{ route('candidatures.store') }}" enctype="multipart/form-data"
              class="space-y-10">
            @csrf

            @include('candidatures._form', ['candidature' => null])

            <div class="flex items-center gap-4 pt-8 border-t border-gray-100">
                <button type="submit" class="btn-primary px-8">
                    🚀 Enregistrer la candidature
                </button>
                <a href="{{ route('candidatures.index') }}" class="btn-ghost">Retour à la liste</a>
            </div>
        </form>
    </div>
</div>

@endsection
