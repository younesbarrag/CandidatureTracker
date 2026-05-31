@extends('layouts.app')

@section('title', 'Archives')

@section('content')

{{-- ── Page Header ────────────────────────────────────────────────────────── --}}
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Archives</h2>
        <p class="text-slate-500 font-medium mt-1">Retrouvez ici vos anciennes candidatures et opportunités clôturées.</p>
    </div>
    <a href="{{ route('candidatures.index') }}" class="btn-secondary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Retour aux candidatures
    </a>
</div>

{{-- ── Archives Table ────────────────────────────────────────────────────── --}}
<div class="bg-white rounded-3xl shadow-premium border border-slate-50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Candidature</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Statut Final</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Archivée le</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($candidatures as $c)
                <tr class="hover:bg-slate-50/30 transition-colors group opacity-75 hover:opacity-100 grayscale hover:grayscale-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 font-bold border border-transparent">
                                {{ substr($c->entreprise, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-extrabold text-slate-900 leading-tight">{{ $c->entreprise }}</p>
                                <p class="text-xs font-semibold text-slate-400 mt-1 uppercase tracking-wider">{{ $c->poste }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
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
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-700 leading-tight">{{ $c->deleted_at->format('d M Y') }}</span>
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mt-1">Archivée</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <form method="POST" action="{{ route('candidatures.restore', $c->id) }}" class="inline-block">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-xs font-bold hover:bg-emerald-100 transition-all active:scale-95 border border-emerald-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                Restaurer
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-32 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Aucune archive</h3>
                        <p class="text-slate-500 font-medium mt-1">Vous n'avez pas encore de candidatures archivées.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($candidatures->hasPages())
    <div class="p-8 bg-slate-50/50 border-t border-slate-50">
        {{ $candidatures->links() }}
    </div>
    @endif
</div>

@endsection
