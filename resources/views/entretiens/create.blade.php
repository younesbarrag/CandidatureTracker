@extends('layouts.app')

@section('title', 'Nouveau Rendez-vous')

@section('content')

<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Programmer un Entretien</h2>
            <p class="text-slate-500 font-medium mt-1">Nouveau rendez-vous pour <strong>{{ $candidature->entreprise }}</strong> ({{ $candidature->poste }}).</p>
        </div>
        <a href="{{ route('candidatures.show', $candidature) }}" class="p-3 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-2xl transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-[2.5rem] shadow-premium border border-slate-50 overflow-hidden">
        <form method="POST" action="{{ route('entretiens.store', $candidature) }}" class="p-8 md:p-12">
            @csrf

            @include('entretiens._form', ['entretien' => null])

            <div class="mt-12 pt-10 border-t border-slate-50 flex flex-col sm:flex-row items-center justify-end gap-4">
                <a href="{{ route('candidatures.show', $candidature) }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors px-6">Annuler</a>
                <button type="submit" class="w-full sm:w-auto btn-primary !px-10 !py-4 text-base">
                    Confirmer le rendez-vous
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
