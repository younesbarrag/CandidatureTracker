@extends('layouts.app')

@section('title', 'Statistiques & Analyses')

@section('content')

{{-- ── Page Header ── --}}
<div class="mb-10">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Analyses de Performance</h2>
    <p class="text-slate-500 font-medium mt-1">Identifiez les forces et faiblesses de votre tunnel de recrutement.</p>
</div>

{{-- ── Conversion Funnel ── --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
    <div class="bg-white rounded-3xl p-8 shadow-premium border border-slate-50 text-center">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Total Candidatures</p>
        <h3 class="text-4xl font-black text-slate-900 tracking-tighter">{{ $total }}</h3>
        <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-slate-400 rounded-full" style="width: 100%"></div>
        </div>
    </div>
    
    <div class="bg-white rounded-3xl p-8 shadow-premium border border-slate-50 text-center">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Taux d'Entretien</p>
        <h3 class="text-4xl font-black text-primary-600 tracking-tighter">{{ $conversion['interviews'] }}%</h3>
        <div class="mt-4 h-1.5 w-full bg-primary-50 rounded-full overflow-hidden">
            <div class="h-full bg-primary-500 rounded-full" style="width: {{ $conversion['interviews'] }}%"></div>
        </div>
        <p class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $withInterviews }} opportunités</p>
    </div>

    <div class="bg-white rounded-3xl p-8 shadow-premium border border-slate-50 text-center">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Taux d'Offre</p>
        <h3 class="text-4xl font-black text-emerald-500 tracking-tighter">{{ $conversion['offers'] }}%</h3>
        <div class="mt-4 h-1.5 w-full bg-emerald-50 rounded-full overflow-hidden">
            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $conversion['offers'] }}%"></div>
        </div>
        <p class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $offers }} offres reçues</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">
    {{-- Evolution Chart --}}
    <div class="bg-white rounded-[2.5rem] shadow-premium p-10 border border-slate-50">
        <h3 class="text-lg font-black text-slate-900 tracking-tight mb-8">Activité Mensuelle</h3>
        <div class="h-80">
            <canvas id="evolutionChart"></canvas>
        </div>
    </div>

    {{-- Outcomes Distribution --}}
    <div class="bg-white rounded-[2.5rem] shadow-premium p-10 border border-slate-50">
        <h3 class="text-lg font-black text-slate-900 tracking-tight mb-8">Résultats d'Entretiens</h3>
        <div class="h-80">
            <canvas id="outcomesChart"></canvas>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    {{-- Priority Pie --}}
    <div class="bg-white rounded-[2.5rem] shadow-premium p-10 border border-slate-50 lg:col-span-1">
        <h3 class="text-lg font-black text-slate-900 tracking-tight mb-8">Priorités</h3>
        <div class="h-64">
            <canvas id="priorityChart"></canvas>
        </div>
    </div>

    {{-- Insights / Summary --}}
    <div class="bg-slate-900 rounded-[2.5rem] shadow-premium p-10 text-white lg:col-span-2 relative overflow-hidden">
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-primary-600/20 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h3 class="text-xl font-black mb-6 tracking-tight">Analyse Rapide</h3>
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-primary-400 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-slate-200">Volume de candidatures</p>
                        <p class="text-sm text-slate-400">Vous avez postulé à {{ $total }} offres au total. Continuez sur cette lancée !</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-emerald-400 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-slate-200">Efficacité du CV</p>
                        <p class="text-sm text-slate-400">Votre taux de conversion en entretien est de {{ $conversion['interviews'] }}%. @if($conversion['interviews'] < 20) Pensez à optimiser vos mots-clés. @else Excellent retour ! @endif</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-amber-400 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-slate-200">Prochaines étapes</p>
                        <p class="text-sm text-slate-400">Concentrez vos efforts sur les candidatures à priorité "Haute" qui n'ont pas encore de rendez-vous.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Evolution Chart
        const evolCtx = document.getElementById('evolutionChart').getContext('2d');
        new Chart(evolCtx, {
            type: 'line',
            data: {
                labels: @json($evolution->pluck('month')),
                datasets: [{
                    label: 'Candidatures',
                    data: @json($evolution->pluck('count')),
                    borderColor: '#7c3aed',
                    backgroundColor: 'rgba(124, 58, 237, 0.05)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 4,
                    pointRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#7c3aed',
                    pointBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Outcomes Chart
        const outCtx = document.getElementById('outcomesChart').getContext('2d');
        new Chart(outCtx, {
            type: 'bar',
            data: {
                labels: @json($resultatsEntretiens->keys()->map(fn($r) => \App\Enums\ResultatEntretien::tryFrom($r)?->label() ?? $r)),
                datasets: [{
                    data: @json($resultatsEntretiens->values()),
                    backgroundColor: ['#10b981', '#f43f5e', '#f59e0b', '#94a3b8'],
                    borderRadius: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Priority Chart
        const prioCtx = document.getElementById('priorityChart').getContext('2d');
        new Chart(prioCtx, {
            type: 'doughnut',
            data: {
                labels: @json($parPriorite->keys()->map(fn($p) => \App\Enums\PrioriteCandidature::tryFrom($p)?->label() ?? $p)),
                datasets: [{
                    data: @json($parPriorite->values()),
                    backgroundColor: ['#f43f5e', '#f59e0b', '#10b981'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { legend: { position: 'bottom' } }
            }
        });
    });
</script>
@endpush
