@extends('layouts.app')

@section('title', $candidature->entreprise . ' — ' . $candidature->poste)
@section('page-title', 'Détails de la candidature')

@section('page-actions')
    <div class="flex items-center gap-2">
        <a href="{{ route('candidatures.edit', $candidature) }}" class="btn-secondary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Modifier
        </a>
        <a href="{{ route('entretiens.create', $candidature) }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Nouvel entretien
        </a>
    </div>
@endsection

@section('content')

<div class="max-w-6xl mx-auto">
    {{-- Fil d'Ariane --}}
    <nav class="flex mb-6 text-sm text-gray-500 font-medium" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
                    <a href="{{ route('candidatures.index') }}" class="hover:text-brand-600 transition-colors">Candidatures</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
                    <span class="text-gray-400">{{ $candidature->entreprise }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ── Colonne principale ──────────────────────────────────────────── --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Header de la candidature --}}
            <div class="card p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                    <div class="flex items-center gap-5">
                        <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 shadow-sm border border-brand-100">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $candidature->poste }}</h2>
                            <p class="text-lg text-gray-500 font-medium">{{ $candidature->entreprise }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="badge {{ $candidature->statut_badge }} text-sm py-1 px-3">{{ $candidature->statut_label }}</span>
                        <span class="badge {{ $candidature->priorite_badge }} text-sm py-1 px-3">{{ $candidature->priorite_label }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 py-6 border-y border-gray-100">
                    <div>
                        <dt class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Date d'envoi</dt>
                        <dd class="text-sm font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $candidature->date_candidature->format('d F Y') }}
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Lien de l'offre</dt>
                        <dd class="text-sm font-bold text-gray-900 truncate">
                            @if($candidature->url_offre)
                                <a href="{{ $candidature->url_offre }}" target="_blank" class="text-brand-600 hover:underline flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    {{ str_replace(['https://', 'http://'], '', $candidature->url_offre) }}
                                </a>
                            @else
                                <span class="text-gray-400 font-medium">Non renseigné</span>
                            @endif
                        </dd>
                    </div>
                </div>

                @if($candidature->notes)
                    <div class="mt-8">
                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Description & Notes
                        </h3>
                        <div class="bg-gray-50 rounded-2xl p-6 text-gray-700 text-sm leading-relaxed whitespace-pre-wrap border border-gray-100">
                            {{ $candidature->notes }}
                        </div>
                    </div>
                @endif
            </div>

            {{-- ── Section Entretiens ─────────────────────────────────────────────── --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between px-2">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                        Entretiens
                        <span class="text-xs bg-brand-100 text-brand-700 px-2.5 py-1 rounded-full">{{ $candidature->entretiens->count() }}</span>
                    </h3>
                    <a href="{{ route('entretiens.create', $candidature) }}" class="btn-ghost btn-sm text-brand-600">
                        + Ajouter un rendez-vous
                    </a>
                </div>

                @forelse($candidature->entretiens as $entretien)
                    <div class="card p-6 flex flex-col md:flex-row md:items-center justify-between gap-6 group">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-sm border border-gray-100 bg-white group-hover:border-brand-200 transition-colors">
                                @if($entretien->type->value === 'visio') 💻
                                @elseif($entretien->type->value === 'telephone') 📞
                                @elseif($entretien->type->value === 'presentiel') 🏢
                                @else 📋 @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $entretien->type_label }}</h4>
                                <p class="text-xs text-gray-500 font-medium flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $entretien->date_heure->format('d M Y à H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="badge {{ $entretien->resultat_badge }} py-1 px-3">
                                {{ $entretien->resultat_label }}
                            </span>
                            <div class="flex items-center gap-1 border-l border-gray-100 pl-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('entretiens.edit', $entretien) }}" class="p-2 text-gray-400 hover:text-brand-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('entretiens.destroy', $entretien) }}" onsubmit="return confirm('Supprimer cet entretien ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card p-12 text-center border-dashed bg-gray-50/50">
                        <p class="text-gray-400 text-sm font-medium mb-4">Aucun entretien programmé</p>
                        <a href="{{ route('entretiens.create', $candidature) }}" class="btn-primary btn-sm">
                            Programmer le premier
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ── Sidebar ────────────────────────────────────────────────────── --}}
        <div class="space-y-6">

            {{-- Document --}}
            <div class="card p-6">
                <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Pièce jointe</h3>
                @if($candidature->cv_path)
                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/><path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-gray-900 truncate">Curriculum Vitae</p>
                                <p class="text-[10px] text-gray-400 font-medium uppercase tracking-tight">Format PDF / DOCX</p>
                            </div>
                        </div>
                        <a href="{{ route('candidatures.download', $candidature) }}" class="w-full btn-secondary btn-sm justify-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Télécharger
                        </a>
                    </div>
                @else
                    <div class="p-8 text-center border-2 border-dashed border-gray-100 rounded-2xl">
                        <p class="text-xs text-gray-400 font-medium">Aucun document joint</p>
                        <a href="{{ route('candidatures.edit', $candidature) }}" class="mt-3 inline-block text-[10px] font-bold text-brand-600 uppercase tracking-widest hover:underline">Ajouter un CV</a>
                    </div>
                @endif
            </div>

            {{-- Métadonnées --}}
            <div class="card p-6">
                <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Informations</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-gray-500 font-medium">Créée le</span>
                        <span class="text-gray-900 font-bold">{{ $candidature->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-gray-500 font-medium">Dernière mise à jour</span>
                        <span class="text-gray-900 font-bold">{{ $candidature->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="pt-4 border-t border-gray-100">
                        <form method="POST" action="{{ route('candidatures.destroy', $candidature) }}" onsubmit="return confirm('Archiver cette candidature ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-xs font-bold text-red-500 hover:text-red-600 transition-colors uppercase tracking-widest flex items-center justify-center gap-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                Archiver la candidature
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
