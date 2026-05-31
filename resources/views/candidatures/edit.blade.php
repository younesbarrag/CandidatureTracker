@extends('layouts.app')

@section('title', 'Modifier ' . $candidature->entreprise)

@section('content')

<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Modifier la Candidature</h2>
            <p class="text-slate-500 font-medium mt-1">Mettez à jour les informations de <strong>{{ $candidature->entreprise }}</strong>.</p>
        </div>
        <a href="{{ route('candidatures.show', $candidature) }}" class="p-3 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-2xl transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-[2.5rem] shadow-premium border border-slate-50 overflow-hidden">
        <form method="POST" action="{{ route('candidatures.update', $candidature) }}" enctype="multipart/form-data" class="p-8 md:p-12">
            @csrf
            @method('PUT')

            @include('candidatures._form')

            <div class="mt-12 pt-10 border-t border-slate-50 flex flex-col sm:flex-row items-center justify-end gap-4">
                <a href="{{ route('candidatures.show', $candidature) }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors px-6">Abandonner</a>
                <button type="submit" class="w-full sm:w-auto btn-primary !px-10 !py-4 text-base">
                    Mettre à jour
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
