@extends('layouts.app')

@section('title', 'Archives')
@section('page-title', 'Candidatures archivées')

@section('page-actions')
    <a href="{{ route('candidatures.index') }}" class="btn-secondary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Retour
    </a>
@endsection

@section('content')

@forelse($candidatures as $candidature)
    @if($loop->first)
    <div class="card overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Entreprise & Poste</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Statut final</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Archivée le</th>
                    <th class="px-6 py-4 text-right"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
    @endif

                <tr class="table-row group opacity-75 grayscale hover:grayscale-0 hover:opacity-100 transition-all">
                    <td class="px-6 py-5">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-700">{{ $candidature->entreprise }}</span>
                            <span class="text-gray-500 text-xs">{{ $candidature->poste }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="badge {{ $candidature->statut_badge }}">{{ $candidature->statut_label }}</span>
                    </td>
                    <td class="px-6 py-5 text-gray-400 text-xs font-medium">
                        {{ $candidature->deleted_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-5 text-right">
                        <form method="POST" action="{{ route('candidatures.restore', $candidature->id) }}" class="inline-block">
                            @csrf
                            <button type="submit" class="btn-secondary btn-sm gap-1 hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Restaurer
                            </button>
                        </form>
                    </td>
                </tr>

    @if($loop->last)
            </tbody>
        </table>
    </div>
    @endif

@empty
    <div class="card p-20 text-center">
        <div class="w-20 h-20 bg-gray-50 text-gray-400 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune archive</h3>
        <p class="text-gray-500 max-w-sm mx-auto">
            Les candidatures que vous supprimez apparaîtront ici. Vous pourrez les restaurer à tout moment.
        </p>
    </div>
@endforelse

@if($candidatures->hasPages())
    <div class="mt-8">{{ $candidatures->links() }}</div>
@endif

@endsection
