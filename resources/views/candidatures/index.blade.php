@extends('layouts.app')

@section('title', 'Mes Candidatures')

@section('content')

{{-- ── Page Header ────────────────────────────────────────────────────────── --}}
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Mes Candidatures</h2>
        <p class="text-slate-500 font-medium mt-1">Gérez et suivez l'évolution de vos opportunités professionnelles.</p>
    </div>
    <a href="{{ route('candidatures.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Nouvelle candidature
    </a>
</div>

{{-- ── Filters ────────────────────────────────────────────────────────────── --}}
<div class="bg-white rounded-3xl shadow-premium p-6 mb-8 border border-slate-50">
    <form method="GET" action="{{ route('candidatures.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
        <div class="md:col-span-5">
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Rechercher</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Entreprise, poste, mots-clés..." 
                       class="w-full bg-slate-50 border-none rounded-2xl py-3 pl-11 pr-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all">
            </div>
        </div>

        <div class="md:col-span-4">
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Statut</label>
            <select name="statut" class="w-full bg-slate-50 border-none rounded-2xl py-3 px-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all appearance-none">
                <option value="">Tous les statuts</option>
                @foreach($statuts as $value => $label)
                    <option value="{{ $value }}" {{ request('statut') == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-3 flex gap-2">
            <button type="submit" class="flex-1 bg-slate-900 text-white rounded-2xl py-3 px-4 text-sm font-bold hover:bg-slate-800 transition-all active:scale-95 shadow-lg shadow-slate-200">
                Filtrer
            </button>
            @if(request()->hasAny(['search', 'statut']))
                <a href="{{ route('candidatures.index') }}" class="w-12 flex items-center justify-center bg-slate-100 text-slate-500 rounded-2xl hover:bg-slate-200 transition-all active:scale-95" title="Réinitialiser">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </a>
            @endif
        </div>
    </form>
</div>

{{-- ── Candidatures Table ────────────────────────────────────────────────── --}}
<div class="bg-white rounded-3xl shadow-premium border border-slate-50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Candidature</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Statut</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Priorité</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Date</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($candidatures as $c)
                <tr class="hover:bg-slate-50/30 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 font-bold group-hover:bg-primary-50 group-hover:text-primary-600 transition-all border border-transparent group-hover:border-primary-100">
                                {{ substr($c->entreprise, 0, 1) }}
                            </div>
                            <div>
                                <a href="{{ route('candidatures.show', $c) }}" class="text-sm font-extrabold text-slate-900 hover:text-primary-600 transition-colors block leading-tight">{{ $c->entreprise }}</a>
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
                        @php
                            $prioClass = match($c->priorite->value) {
                                'haute' => 'text-rose-600',
                                'moyenne' => 'text-amber-600',
                                'basse' => 'text-emerald-600',
                                default => 'text-slate-600'
                            };
                        @endphp
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full 
                                @if($c->priorite->value == 'haute') bg-rose-500 @elseif($c->priorite->value == 'moyenne') bg-amber-500 @else bg-emerald-500 @endif"></span>
                            <span class="text-xs font-bold {{ $prioClass }} uppercase tracking-widest">{{ $c->priorite->label() }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-700 leading-tight">{{ $c->date_candidature->format('d M Y') }}</span>
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mt-1">Soumis</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2" x-data="{ open: false }">
                            <a href="{{ route('candidatures.show', $c) }}" class="p-2.5 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all" title="Détails">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            
                            <div class="relative">
                                <button @click="open = !open" class="p-2.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                                </button>
                                
                                <div x-show="open" @click.away="open = false" 
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-2xl border border-slate-100 py-2 z-50 animate-in fade-in zoom-in duration-200" x-cloak>
                                    <a href="{{ route('candidatures.edit', $c) }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-primary-600 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Modifier
                                    </a>
                                    <form action="{{ route('candidatures.destroy', $c) }}" method="POST" onsubmit="return confirm('Archiver cette candidature ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-amber-600 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                            Archiver
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-32 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Aucun résultat</h3>
                        <p class="text-slate-500 font-medium mt-1 mb-8">Nous n'avons trouvé aucune candidature correspondant à votre recherche.</p>
                        <a href="{{ route('candidatures.index') }}" class="btn-secondary">Réinitialiser les filtres</a>
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
