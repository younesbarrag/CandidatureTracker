@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Bonjour, ' . auth()->user()->name . ' 👋')

@section('page-actions')
    <a href="{{ route('candidatures.create') }}" class="btn-primary">+ Nouvelle candidature</a>
@endsection

@section('content')

{{-- ── Stats cards ─────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    @php
    $statCards = [
        ['label' => 'Candidatures actives', 'value' => $stats['total'],                'icon' => '📄', 'color' => 'blue'],
        ['label' => 'Entretiens en attente', 'value' => $stats['entretiens_planifies'], 'icon' => '📅', 'color' => 'purple'],
        ['label' => 'Offres reçues',          'value' => $stats['offres_recues'],        'icon' => '🎉', 'color' => 'green'],
        ['label' => 'Archivées',              'value' => 0,                              'icon' => '📁', 'color' => 'gray'],
    ];
    @endphp

    @foreach($statCards as $card)
    <div class="card p-5">
        <div class="flex items-start justify-between mb-3">
            <span class="text-2xl">{{ $card['icon'] }}</span>
            <span class="text-3xl font-extrabold text-gray-900">{{ $card['value'] }}</span>
        </div>
        <p class="text-sm text-gray-500 font-medium">{{ $card['label'] }}</p>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- ── Candidatures récentes ─────────────────────────────────────── --}}
    <div class="card">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Candidatures récentes</h2>
            <a href="{{ route('candidatures.index') }}" class="text-xs text-brand-600 hover:underline">
                Voir toutes →
            </a>
        </div>

        @forelse($recentes as $candidature)
            <div class="flex items-center justify-between px-6 py-3.5 border-b border-gray-50 last:border-0 hover:bg-gray-50 transition">
                <div>
                    <a href="{{ route('candidatures.show', $candidature) }}"
                       class="text-sm font-semibold text-gray-900 hover:text-brand-600">
                        {{ $candidature->entreprise }}
                    </a>
                    <p class="text-xs text-gray-500">{{ $candidature->poste }}</p>
                </div>
                <span class="badge {{ $candidature->statut_badge }} flex-shrink-0">
                    {{ $candidature->statut_label }}
                </span>
            </div>
        @empty
            <div class="px-6 py-10 text-center">
                <p class="text-gray-400 text-sm">Aucune candidature.</p>
                <a href="{{ route('candidatures.create') }}" class="mt-3 btn-primary btn-sm inline-flex">
                    Créer ma première candidature
                </a>
            </div>
        @endforelse
    </div>

    {{-- ── Prochains entretiens ──────────────────────────────────────── --}}
    <div class="card">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Prochains entretiens</h2>
        </div>

        @forelse($prochainsEntretiens as $entretien)
            <div class="flex items-center justify-between px-6 py-3.5 border-b border-gray-50 last:border-0">
                <div>
                    <p class="text-sm font-semibold text-gray-900">
                        {{ $entretien->candidature->entreprise ?? '—' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $entretien->type_label }} · {{ $entretien->date_heure->format('d/m/Y à H:i') }}
                    </p>
                </div>
                <span class="badge badge-yellow flex-shrink-0">À venir</span>
            </div>
        @empty
            <div class="px-6 py-10 text-center">
                <p class="text-gray-400 text-sm">Aucun entretien à venir.</p>
            </div>
        @endforelse
    </div>

    {{-- ── Répartition par statut ────────────────────────────────────── --}}
    <div class="card lg:col-span-2">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Répartition par statut</h2>
        </div>
        <div class="p-6">
            @if($parStatut->isEmpty())
                <p class="text-center text-gray-400 text-sm py-6">Aucune donnée.</p>
            @else
                <div class="space-y-3">
                    @php $total = $parStatut->sum(); @endphp
                    @foreach($parStatut as $statut => $count)
                        @php
                            $pct = $total > 0 ? round(($count / $total) * 100) : 0;
                            $enum = \App\Enums\StatutCandidature::tryFrom($statut);
                        @endphp
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-600 w-44 flex-shrink-0">{{ $enum?->label() ?? $statut }}</span>
                            <div class="flex-1 bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                <div class="h-full bg-brand-500 rounded-full transition-all" style="width: {{ $pct }}%"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 w-8 text-right">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
