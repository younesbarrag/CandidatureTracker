@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')

{{-- ── Welcome Header ────────────────────────────────────────────────────────── --}}
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Bonjour, {{ auth()->user()->name }} 👋</h2>
        <p class="text-slate-500 font-medium mt-1">Voici un aperçu de vos activités de recrutement aujourd'hui.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('candidatures.index') }}" class="btn-secondary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            Voir la liste
        </a>
        <a href="{{ route('candidatures.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nouvelle candidature
        </a>
    </div>
</div>

{{-- ── KPI Cards ────────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    @php
    $cards = [
        [
            'label' => 'Candidatures Actives',
            'value' => $stats['total'],
            'trend' => '+12% ce mois',
            'color' => 'primary',
            'icon' => '<path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />'
        ],
        [
            'label' => 'Entretiens Planifiés',
            'value' => $stats['entretiens_planifies'],
            'trend' => '3 cette semaine',
            'color' => 'amber',
            'icon' => '<path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />'
        ],
        [
            'label' => 'Offres Reçues',
            'value' => $stats['offres_recues'],
            'trend' => 'Félicitations !',
            'color' => 'emerald',
            'icon' => '<path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-2.06 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946 2.06 3.42 3.42 0 013.134 3.134 3.42 3.42 0 002.06 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-2.06 1.946 3.42 3.42 0 01-3.134 3.134 3.42 3.42 0 00-1.946 2.06 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-2.06 3.42 3.42 0 01-3.134-3.134 3.42 3.42 0 00-2.06-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 002.06-1.946 3.42 3.42 0 013.134-3.134z" />'
        ],
        [
            'label' => 'Candidatures Archivées',
            'value' => $stats['archives'],
            'trend' => 'Historique',
            'color' => 'slate',
            'icon' => '<path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />'
        ],
    ];
    @endphp

    @foreach($cards as $card)
    <div class="bg-white rounded-3xl p-6 shadow-premium hover:shadow-premium-hover transition-all duration-300 group relative overflow-hidden">
        <div class="absolute -right-6 -top-6 w-24 h-24 
            @if($card['color'] == 'primary') bg-primary-50 @elseif($card['color'] == 'amber') bg-amber-50 @elseif($card['color'] == 'emerald') bg-emerald-50 @else bg-slate-50 @endif
            rounded-full transition-transform group-hover:scale-150 duration-500 opacity-50"></div>
        
        <div class="relative z-10">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-5 
                @if($card['color'] == 'primary') bg-primary-100 text-primary-600 @elseif($card['color'] == 'amber') bg-amber-100 text-amber-600 @elseif($card['color'] == 'emerald') bg-emerald-100 text-emerald-600 @else bg-slate-100 text-slate-600 @endif
                group-hover:rotate-12 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $card['icon'] !!}</svg>
            </div>
            <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">{{ $card['label'] }}</p>
            <div class="flex items-end gap-3">
                <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $card['value'] }}</h3>
                <span class="text-[10px] font-black 
                    @if($card['color'] == 'primary') text-primary-500 @elseif($card['color'] == 'amber') text-amber-500 @elseif($card['color'] == 'emerald') text-emerald-500 @else text-slate-400 @endif
                    mb-1.5 uppercase tracking-widest">{{ $card['trend'] }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- ── Recent Applications ────────────────────────────────────────── --}}
    <div class="lg:col-span-2 bg-white rounded-3xl shadow-premium overflow-hidden border border-slate-50">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">Candidatures Récentes</h3>
                <p class="text-slate-400 text-xs font-semibold mt-0.5 uppercase tracking-wider">Suivi en temps réel</p>
            </div>
            <a href="{{ route('candidatures.index') }}" class="text-sm font-bold text-primary-600 hover:text-primary-700 transition-colors">Voir tout</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-8 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Entreprise</th>
                        <th class="px-8 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Poste</th>
                        <th class="px-8 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Statut</th>
                        <th class="px-8 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($recentes as $c)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 font-bold group-hover:bg-primary-50 group-hover:text-primary-600 transition-all">
                                    {{ substr($c->entreprise, 0, 1) }}
                                </div>
                                <span class="text-sm font-bold text-slate-900">{{ $c->entreprise }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-sm font-medium text-slate-500">{{ $c->poste }}</td>
                        <td class="px-8 py-5">
                            @php
                                $badgeClass = match($c->statut->value) {
                                    'envoyee' => 'bg-blue-100 text-blue-700',
                                    'entretien_planifie' => 'bg-amber-100 text-amber-700',
                                    'offre_recue' => 'bg-emerald-100 text-emerald-700',
                                    'refusee' => 'bg-rose-100 text-rose-700',
                                    default => 'bg-slate-100 text-slate-700'
                                };
                            @endphp
                            <span class="badge-modern {{ $badgeClass }}">
                                {{ $c->statut->label() }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <a href="{{ route('candidatures.show', $c) }}" class="p-2 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all inline-block">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-slate-400 font-medium italic">Aucune candidature récente</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Statistics & Distribution ─────────────────────────────────── --}}
    <div class="space-y-8">
        {{-- Distribution Chart --}}
        <div class="bg-white rounded-3xl shadow-premium p-8 border border-slate-50">
            <h3 class="text-lg font-extrabold text-slate-900 tracking-tight mb-6">Répartition</h3>
            <div class="h-64 relative">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="mt-8 grid grid-cols-2 gap-4">
                @foreach($parStatut as $statut => $count)
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full 
                        @if($statut == 'envoyee') bg-blue-500 @elseif($statut == 'entretien_planifie') bg-amber-500 @elseif($statut == 'offre_recue') bg-emerald-500 @elseif($statut == 'refusee') bg-rose-500 @else bg-slate-400 @endif"></span>
                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">{{ \App\Enums\StatutCandidature::tryFrom($statut)?->label() ?? $statut }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Next Interview --}}
        <div class="bg-gradient-to-br from-primary-600 to-indigo-700 rounded-3xl shadow-xl shadow-primary-500/20 p-8 text-white relative overflow-hidden group">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
            
            <h3 class="text-sm font-black uppercase tracking-[0.2em] mb-6 opacity-80">Prochain Entretien</h3>
            
            @if($prochainsEntretiens->count() > 0)
                @php $next = $prochainsEntretiens->first(); @endphp
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex flex-col items-center justify-center border border-white/20">
                        <span class="text-[10px] font-black uppercase leading-none opacity-80">{{ $next->date_heure->translatedFormat('M') }}</span>
                        <span class="text-xl font-black leading-none mt-1">{{ $next->date_heure->format('d') }}</span>
                    </div>
                    <div>
                        <p class="font-extrabold text-lg leading-tight">{{ $next->candidature->entreprise }}</p>
                        <p class="text-white/70 text-sm font-medium">{{ $next->date_heure->format('H:i') }} · {{ $next->type_label }}</p>
                    </div>
                </div>
                <a href="{{ route('candidatures.show', $next->candidature) }}" class="flex items-center justify-center w-full py-3 bg-white text-primary-600 rounded-xl font-bold text-sm hover:bg-primary-50 transition-all">
                    Détails du poste
                </a>
            @else
                <div class="py-10 text-center">
                    <p class="text-white/60 text-sm font-bold uppercase tracking-widest italic">Aucun rendez-vous</p>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('statusChart').getContext('2d');
        const data = {
            labels: @json($parStatut->keys()->map(fn($s) => \App\Enums\StatutCandidature::tryFrom($s)?->label() ?? $s)),
            datasets: [{
                data: @json($parStatut->values()),
                backgroundColor: [
                    '#3b82f6', // Envoyée (Blue)
                    '#f59e0b', // Entretien (Amber)
                    '#10b981', // Offre (Emerald)
                    '#f43f5e', // Refusée (Rose)
                    '#94a3b8'  // Autre (Slate)
                ],
                borderWidth: 0,
                hoverOffset: 15
            }]
        };

        new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    });
</script>
@endpush
