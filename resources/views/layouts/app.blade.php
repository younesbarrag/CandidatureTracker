<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CandidatureTracker') — CandidatureTracker</title>

    {{-- Tailwind CDN (en production, utiliser Vite + npm) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50:'#eff6ff', 100:'#dbeafe', 500:'#3b82f6', 600:'#2563eb', 700:'#1d4ed8', 900:'#1e3a8a' }
                    },
                    fontFamily: {
                        sans: ['"Inter"', 'system-ui', 'sans-serif'],
                        mono: ['"Fira Code"', 'monospace'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ── Badges ─────────────────────────────────────────────── */
        .badge { @apply inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold; }
        .badge-blue   { @apply bg-blue-100 text-blue-800; }
        .badge-yellow { @apply bg-yellow-100 text-yellow-800; }
        .badge-green  { @apply bg-emerald-100 text-emerald-800; }
        .badge-red    { @apply bg-red-100 text-red-800; }
        .badge-purple { @apply bg-purple-100 text-purple-800; }
        .badge-gray   { @apply bg-gray-100 text-gray-700; }

        /* ── Cards ───────────────────────────────────────────────── */
        .card { @apply bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden; }

        /* ── Inputs ──────────────────────────────────────────────── */
        .input {
            @apply w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent
                   transition placeholder-gray-400;
        }
        .input-error { @apply border-red-400 bg-red-50; }

        /* ── Buttons ─────────────────────────────────────────────── */
        .btn         { @apply inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-1; }
        .btn-primary { @apply btn bg-brand-600 text-white hover:bg-brand-700 focus:ring-brand-500; }
        .btn-secondary { @apply btn bg-gray-100 text-gray-700 hover:bg-gray-200 focus:ring-gray-400; }
        .btn-danger   { @apply btn bg-red-600 text-white hover:bg-red-700 focus:ring-red-500; }
        .btn-ghost    { @apply btn text-gray-600 hover:bg-gray-100 focus:ring-gray-300; }
        .btn-sm       { @apply !px-3 !py-1.5 !text-xs; }

        /* ── Nav active ──────────────────────────────────────────── */
        .nav-link       { @apply flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition; }
        .nav-link.active { @apply bg-brand-50 text-brand-700 font-semibold; }

        /* ── Tables ──────────────────────────────────────────────── */
        .table-row { @apply hover:bg-gray-50 transition border-b border-gray-100 last:border-0; }
    </style>
</head>
<body class="h-full bg-gray-50 font-sans antialiased">

<div class="flex h-full">

    {{-- ── Sidebar ──────────────────────────────────────────────────────── --}}
    <aside class="hidden md:flex md:w-64 md:flex-col bg-white border-r border-gray-100 fixed inset-y-0">
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100">
            <div class="w-9 h-9 bg-brand-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">C</div>
            <div>
                <p class="text-sm font-bold text-gray-900">CandidatureTracker</p>
                <p class="text-xs text-gray-500">Gestion des candidatures</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('candidatures.index') }}"
               class="nav-link {{ request()->routeIs('candidatures.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Candidatures
            </a>

            <a href="{{ route('candidatures.archives') }}"
               class="nav-link {{ request()->routeIs('candidatures.archives') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                Archives
            </a>
        </nav>

        {{-- User info --}}
        <div class="px-4 py-4 border-t border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-brand-100 rounded-full flex items-center justify-center text-brand-700 font-semibold text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-gray-600 transition" title="Déconnexion">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ── Main Content ──────────────────────────────────────────────────── --}}
    <main class="flex-1 md:ml-64 min-h-full flex flex-col">

        {{-- Top bar --}}
        <header class="bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between">
            <h1 class="text-lg font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center gap-2">
                @yield('page-actions')
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mx-6 mt-4 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm" role="alert">
                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mx-6 mt-4 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm" role="alert">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Page content --}}
        <div class="flex-1 px-6 py-6">
            @yield('content')
        </div>
    </main>
</div>

</body>
</html>
