@extends('layouts.app')

@section('title', $candidature->entreprise . ' — ' . $candidature->poste)

@section('content')

<div class="max-w-6xl mx-auto">
    {{-- ── Breadcrumbs ── --}}
    <nav class="flex mb-8 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
        <ol class="flex items-center gap-2">
            <li><a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Dashboard</a></li>
            <li><svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
            <li><a href="{{ route('candidatures.index') }}" class="hover:text-primary-600 transition-colors">Candidatures</a></li>
            <li><svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
            <li class="text-slate-600">{{ $candidature->entreprise }}</li>
        </ol>
    </nav>

    {{-- ── Header Section ── --}}
    <div class="mb-10 flex flex-col lg:flex-row lg:items-end justify-between gap-8">
        <div class="flex items-start gap-6">
            <div class="w-20 h-20 bg-white rounded-3xl shadow-premium border border-slate-50 flex items-center justify-center text-3xl font-black text-primary-600">
                {{ substr($candidature->entreprise, 0, 1) }}
            </div>
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-2">
                    @php
                        $badgeClass = match($candidature->statut->value) {
                            'envoyee' => 'bg-blue-100 text-blue-700',
                            'entretien_planifie' => 'bg-amber-100 text-amber-700',
                            'offre_recue' => 'bg-emerald-100 text-emerald-700',
                            'refusee' => 'bg-rose-100 text-rose-700',
                            default => 'bg-slate-100 text-slate-700'
                        };
                    @endphp
                    <span class="badge-modern {{ $badgeClass }}">{{ $candidature->statut->label() }}</span>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">•</span>
                    <span class="text-xs font-bold @if($candidature->priorite->value == 'haute') text-rose-500 @elseif($candidature->priorite->value == 'moyenne') text-amber-500 @else text-emerald-500 @endif uppercase tracking-widest">Priorité {{ $candidature->priorite->label() }}</span>
                </div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight leading-tight">{{ $candidature->poste }}</h2>
                <p class="text-xl font-bold text-slate-500">{{ $candidature->entreprise }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('candidatures.edit', $candidature) }}" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Modifier
            </a>
            <a href="{{ route('entretiens.create', $candidature) }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Ajouter un entretien
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        {{-- ── Left Column: Details & Interviews ── --}}
        <div class="lg:col-span-2 space-y-10">
            {{-- Overview Card --}}
            <div class="bg-white rounded-[2.5rem] shadow-premium p-10 border border-slate-50">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Informations Générales</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Postulé le</p>
                                <p class="text-sm font-extrabold text-slate-900">{{ $candidature->date_candidature->format('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Lien de l'offre</p>
                                @if($candidature->url_offre)
                                    <a href="{{ $candidature->url_offre }}" target="_blank" class="text-sm font-extrabold text-primary-600 hover:text-primary-700 transition-colors block truncate">{{ $candidature->url_offre }}</a>
                                @else
                                    <p class="text-sm font-bold text-slate-400 italic">Non renseigné</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Résumé des Notes</p>
                        <p class="text-sm text-slate-600 font-medium leading-relaxed italic">
                            {{ $candidature->notes ?: "Aucune note particulière renseignée pour cette candidature." }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Interviews Section --}}
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Historique des Entretiens</h3>
                    <span class="bg-slate-100 text-slate-500 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">{{ $candidature->entretiens->count() }} Session(s)</span>
                </div>

                @forelse($candidature->entretiens as $e)
                <div class="bg-white rounded-[2.5rem] shadow-premium p-8 border border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 group hover:border-primary-100 transition-all">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-slate-50 flex flex-col items-center justify-center text-slate-400 group-hover:bg-primary-50 group-hover:text-primary-600 transition-all border border-transparent group-hover:border-primary-100">
                            <span class="text-[10px] font-black uppercase leading-none">{{ $e->date_heure->translatedFormat('M') }}</span>
                            <span class="text-2xl font-black leading-none mt-1">{{ $e->date_heure->format('d') }}</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm font-black text-slate-900">{{ $e->type_label }}</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-xs font-bold text-slate-500">{{ $e->date_heure->format('H:i') }}</span>
                            </div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">{{ $e->lieu ?: 'Lieu non spécifié' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        @php
                            $resClass = match($e->resultat?->value) {
                                'positif' => 'bg-emerald-100 text-emerald-700',
                                'negatif' => 'bg-rose-100 text-rose-700',
                                'attente' => 'bg-amber-100 text-amber-700',
                                default => 'bg-slate-100 text-slate-700'
                            };
                        @endphp
                        <span class="badge-modern {{ $resClass }}">{{ $e->resultat_label }}</span>
                        <div class="h-8 w-px bg-slate-100"></div>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('entretiens.edit', $e) }}" class="p-2 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('entretiens.destroy', $e) }}" method="POST" onsubmit="return confirm('Supprimer cet entretien ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-slate-50/50 rounded-[2.5rem] p-12 text-center border-2 border-dashed border-slate-100">
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Aucun entretien enregistré</p>
                    <a href="{{ route('entretiens.create', $candidature) }}" class="mt-4 inline-flex text-primary-600 font-black text-sm hover:underline">Programmer le premier rendez-vous</a>
                </div>
                @endforelse
            </div>
        </div>

        {{-- ── Right Column: Sidebar Stats ── --}}
        <div class="space-y-8">
            {{-- Document Card --}}
            <div class="bg-white rounded-[2.5rem] shadow-premium p-8 border border-slate-50">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Document Joint</h3>
                @if($candidature->cv_path)
                    <div class="bg-primary-50 rounded-3xl p-6 border border-primary-100 relative overflow-hidden group">
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-primary-600 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="text-sm font-black text-slate-900">Curriculum Vitae</p>
                            <p class="text-xs font-bold text-slate-500 mb-6 uppercase tracking-widest">Document PDF</p>
                            <a href="{{ route('candidatures.download', $candidature) }}" class="w-full flex items-center justify-center py-3 bg-primary-600 text-white rounded-xl font-bold text-sm hover:bg-primary-700 transition-all shadow-lg shadow-primary-500/25">
                                Télécharger
                            </a>
                        </div>
                    </div>
                @else
                    <div class="bg-slate-50 rounded-3xl p-10 text-center border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Aucun CV</p>
                        <a href="{{ route('candidatures.edit', $candidature) }}" class="mt-2 block text-[10px] font-black text-primary-600 uppercase tracking-[0.2em] hover:underline">Ajouter un document</a>
                    </div>
                @endif
            </div>

            {{-- Metadata Card --}}
            <div class="bg-slate-900 rounded-[2.5rem] shadow-premium p-8 text-white relative overflow-hidden group">
                <div class="absolute -left-10 -top-10 w-40 h-40 bg-primary-600/20 rounded-full blur-3xl"></div>
                
                <h3 class="text-[10px] font-black text-white/40 uppercase tracking-[0.2em] mb-6 relative z-10">Métadonnées</h3>
                <div class="space-y-4 relative z-10">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-white/60">Ajouté le</span>
                        <span class="text-xs font-black">{{ $candidature->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-white/60">Dernier Edit</span>
                        <span class="text-xs font-black">{{ $candidature->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="h-px bg-white/10 my-4"></div>
                    <form action="{{ route('candidatures.destroy', $candidature) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment archiver cette candidature ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center gap-2 text-rose-400 hover:text-rose-300 transition-colors font-black text-[10px] uppercase tracking-[0.2em]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                            Archiver la candidature
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
