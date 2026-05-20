@extends('layouts.app')

@section('title', 'Nouvelle candidature')
@section('page-title', 'Nouvelle candidature')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="card p-8">
        <form method="POST" action="{{ route('candidatures.store') }}" enctype="multipart/form-data"
              class="space-y-5">
            @csrf

            @include('candidatures._form')

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    🚀 Créer la candidature
                </button>
                <a href="{{ route('candidatures.index') }}" class="btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
