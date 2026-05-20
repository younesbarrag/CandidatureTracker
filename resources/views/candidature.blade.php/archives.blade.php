@extends('layouts.app')

@section('title', 'Archives')
@section('page-title', 'Candidatures archivées')

@section('page-actions')
    <a href="{{ route('candidatures.index') }}" class="btn-secondary">← Retour</a>
@endsection

@section('content')

@forelse($candidatures as $candidature)
    @if($loop->first)
    <div class="card">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Entreprise</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Poste</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Statut</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Archivée le</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody>
    @endif

                <tr class="table-row opacity-75">
                    <td class="px-5 py-4 font-medium text-gray-700">{{ $candidature->entreprise }}</td>
                    <td class="px-5 py-4 text-gray-500">{{ $candidature->poste }}</td>
                    <td class="px-5 py-4">
                        <span class="badge {{ $candidature->statut_badge }}">{{ $candidature->statut_label }}</span>
                    </td>
                    <td class="px-5 py-4 text-gray-400 text-xs">
                        {{ $candidature->deleted_at->format('d/m/Y') }}
                    </td>
                    <td class="px-5 py-4 text-right">
                        <form method="POST" action="{{ route('candidatures.restore', $candidature->id) }}">
                            @csrf
                            <button type="submit" class="btn-secondary btn-sm">
                                ♻️ Restaurer
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
    <div class="card p-16 text-center">
        <p class="text-gray-400">Aucune candidature archivée.</p>
    </div>
@endforelse

@if($candidatures->hasPages())
    <div class="mt-6">{{ $candidatures->links() }}</div>
@endif

@endsection
