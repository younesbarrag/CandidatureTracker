@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title')
    <div class="flex flex-col">
        <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest mb-1">Vue d'ensemble</span>
        <span class="text-2xl font-extrabold text-slate-900 tracking-tight">Bonjour, {{ auth()->user()->name }} 👋</span>
    </div>
@endsection

@section('page-actions')
    <a href="{{ route('candidatures.create') }}" 
       class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-indigo-200/50 active:scale-95 transition-all duration-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        <span>Nouvelle candidature</span>
    </a>
@endsection

@section('content')

{{-- ── KPI Stats Cards ────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

    @php
    $statCards = [
        [
            'label' => 'Candidatures actives', 
            'value' => $stats['total'], 
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>', 
            'color' => 'indigo'
        ],
        [
            'label' => 'Entretiens', 
            'value' => $stats['entretiens_planifies'], 
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>', 
            'color' => 'purple'
        ],
        [
            'label' => 'Offres reçues', 
            'value' => $stats['offres_recues'], 
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"/>', 
            'color' => 'emerald'
        ],
        [
            'label' => 'Archivées', 
            'value' => $stats['archives'], 
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>', 
            'color' => 'slate'
        ],
    ];
    @endphp

    @foreach($statCards as $card)
    <div class="card p-6 group hover:-translate-y-1 transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center 
                @if($card['color'] == 'indigo') bg-indigo-50 text-indigo-600 @endif
                @if($card['color'] == 'purple') bg-purple-50 text-purple-600 @endif
                @if($card['color'] == 'emerald') bg-emerald-50 text-emerald-600 @endif
                @if($card['color'] == 'slate') bg-slate-50 text-slate-500 @endif
                transition-transform group-hover:scale-110 duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $card['icon'] !!}
                </svg>
            </div>
            <div class="text-right">
                <span class="block text-3xl font-black text-slate-900 tracking-tight">{{ $card['value'] }}</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total</span>
            </div>
        </div>
        <p class="text-sm font-bold text-slate-600">{{ $card['label'] }}</p>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

    {{-- ── Candidatures récentes ─────────────────────────────────────── --}}
    <div class="card border-none shadow-premium ring-1 ring-slate-100">
        <div class="flex items-center justify-between px-8 py-6 border-b border-slate-50">
            <div>
                <h2 class="font-bold text-slate-900 tracking-tight">Candidatures récentes</h2>
                <p class="text-xs text-slate-400 mt-0.5">Dernières opportunités ajoutées</p>
            </div>
            <a href="{{ route('candidatures.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-700 bg-indigo-50 px-3 py-1.5 rounded-lg transition-colors">
                Voir tout
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="divide-y divide-slate-50">
            @forelse($recentes as $candidature)
                <div class="flex items-center justify-between px-8 py-5 hover:bg-slate-50/50 transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 font-bold group-hover:bg-white group-hover:shadow-sm transition-all border border-transparent group-hover:border-slate-100">
                            {{ substr($candidature->entreprise, 0, 1) }}
                        </div>
                        <div>
                            <a href="{{ route('candidatures.show', $candidature) }}"
                               class="text-sm font-bold text-slate-900 hover:text-indigo-600 block transition-colors">
                                {{ $candidature->entreprise }}
                            </a>
                            <p class="text-xs font-medium text-slate-500">{{ $candidature->poste }}</p>
                        </div>
                    </div>
                    <span class="badge {{ $candidature->statut_badge }}">
                        {{ $candidature->statut_label }}
                    </span>
                </div>
            @empty
                <div class="px-8 py-16 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Aucune candidature pour le moment.</p>
                    <a href="{{ route('candidatures.create') }}" class="mt-4 btn btn-secondary btn-sm">
                        Ajouter ma première offre
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ── Prochains entretiens ──────────────────────────────────────── --}}
    <div class="card border-none shadow-premium ring-1 ring-slate-100">
        <div class="flex items-center justify-between px-8 py-6 border-b border-slate-50">
            <div>
                <h2 class="font-bold text-slate-900 tracking-tight">Prochains rendez-vous</h2>
                <p class="text-xs text-slate-400 mt-0.5">Votre agenda de recrutement</p>
            </div>
            <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center text-amber-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>

        <div class="divide-y divide-slate-50">
            @forelse($prochainsEntretiens as $entretien)
                <div class="flex items-center justify-between px-8 py-5 hover:bg-slate-50/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="flex flex-col items-center justify-center w-12 h-12 bg-indigo-50 rounded-xl text-indigo-600 border border-indigo-100 shadow-sm shadow-indigo-50">
                            <span class="text-[10px] font-black uppercase leading-none">{{ $entretien->date_heure->translatedFormat('M') }}</span>
                            <span class="text-lg font-black leading-none mt-0.5">{{ $entretien->date_heure->format('d') }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">
                                {{ $entretien->candidature->entreprise ?? '—' }}
                            </p>
                            <p class="text-xs font-medium text-slate-500">
                                {{ $entretien->type_label }} · {{ $entretien->date_heure->format('H:i') }}
                            </p>
                        </div>
                    </div>
                    <span class="badge badge-yellow">À venir</span>
                </div>
            @empty
                <div class="px-8 py-16 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Aucun entretien programmé.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ── Répartition par statut ────────────────────────────────────── --}}
    <div class="card lg:col-span-2 border-none shadow-premium ring-1 ring-slate-100 overflow-visible">
        <div class="px-8 py-6 border-b border-slate-50">
            <h2 class="font-bold text-slate-900 tracking-tight">Répartition par statut</h2>
            <p class="text-xs text-slate-400 mt-0.5">Analyse visuelle de votre tunnel de recrutement</p>
        </div>
        <div class="p-8">
            @if($parStatut->isEmpty())
                <div class="py-10 text-center">
                    <p class="text-slate-400 text-sm font-medium italic">En attente de données pour générer le graphique...</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                    @php $total = $parStatut->sum(); @endphp
                    @foreach($parStatut as $statut => $count)
                        @php
                            $pct = $total > 0 ? round(($count / $total) * 100) : 0;
                            $enum = \App\Enums\StatutCandidature::tryFrom($statut);
                            
                            $colorClass = match($enum) {
                                \App\Enums\StatutCandidature::OffreRecue => 'bg-emerald-500',
                                \App\Enums\StatutCandidature::EntretienPlanifie => 'bg-amber-500',
                                \App\Enums\StatutCandidature::Envoyee => 'bg-indigo-500',
                                \App\Enums\StatutCandidature::Refusee => 'bg-rose-500',
                                default => 'bg-slate-400',
                            };

                            $bgLightClass = match($enum) {
                                \App\Enums\StatutCandidature::OffreRecue => 'bg-emerald-50',
                                \App\Enums\StatutCandidature::EntretienPlanifie => 'bg-amber-50',
                                \App\Enums\StatutCandidature::Envoyee => 'bg-indigo-50',
                                \App\Enums\StatutCandidature::Refusee => 'bg-rose-50',
                                default => 'bg-slate-50',
                            };
                        @endphp
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-700 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $colorClass }}"></span>
                                    {{ $enum?->label() ?? $statut }}
                                </span>
                                <span class="text-xs font-black text-slate-900">{{ $count }} <span class="text-slate-400 font-medium ml-1">({{ $pct }}%)</span></span>
                            </div>
                            <div class="relative h-2.5 w-full {{ $bgLightClass }} rounded-full overflow-hidden" x-data="{ width: 0 }" x-init="setTimeout(() => width = {{ $pct }}, 200)">
                                <div class="absolute inset-y-0 left-0 {{ $colorClass }} rounded-full transition-all duration-1000 cubic-bezier(0.4, 0, 0.2, 1) shadow-[0_0_10px_rgba(0,0,0,0.05)]" 
                                     :style="`width: ${width}%`"
                                >
                                    <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
