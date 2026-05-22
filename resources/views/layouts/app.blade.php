<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CandidatureTracker') — CandidatureTracker</title>

    {{-- Tailwind CDN (en production, utiliser Vite + npm) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                    },
                    boxShadow: {
                        'premium': '0 8px 30px rgb(0,0,0,0.04)',
                        'premium-hover': '0 12px 40px rgb(0,0,0,0.08)',
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
        .badge-blue   { @apply bg-blue-50 text-blue-700 border border-blue-100; }
        .badge-yellow { @apply bg-amber-50 text-amber-700 border border-amber-100; }
        .badge-green  { @apply bg-emerald-50 text-emerald-700 border border-emerald-100; }
        .badge-red    { @apply bg-rose-50 text-rose-700 border border-rose-100; }
        .badge-purple { @apply bg-purple-50 text-purple-700 border border-purple-100; }
        .badge-gray   { @apply bg-slate-100 text-slate-700 border border-slate-200; }

        /* ── Cards ───────────────────────────────────────────────── */
        .card { @apply bg-white rounded-2xl shadow-premium border border-slate-100 overflow-hidden transition-all duration-300; }
        .card:hover { @apply shadow-premium-hover border-slate-200; }

        /* ── Inputs ──────────────────────────────────────────────── */
        .input {
            @apply w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500
                   transition-all placeholder-slate-400;
        }
        .input:focus { @apply bg-white; }
        .input-error { @apply border-rose-200 bg-rose-50; }

        /* ── Buttons ─────────────────────────────────────────────── */
        .btn         { @apply inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-medium transition-all focus:outline-none focus:ring-2 focus:ring-offset-1 active:scale-95; }
        .btn-primary { @apply btn bg-slate-900 text-white hover:bg-slate-800 focus:ring-slate-500 shadow-sm; }
        .btn-secondary { @apply btn bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 focus:ring-slate-200; }
        .btn-danger   { @apply btn bg-rose-600 text-white hover:bg-rose-700 focus:ring-rose-500; }
        .btn-ghost    { @apply btn text-slate-600 hover:bg-slate-50 hover:text-slate-900 focus:ring-slate-200; }
        .btn-sm       { @apply !px-3 !py-1.5 !text-xs; }

        /* ── Nav active ──────────────────────────────────────────── */
        .nav-link       { @apply flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all duration-200; }
        .nav-link svg   { @apply transition-transform duration-200 text-slate-400; }
        .nav-link:hover svg { @apply text-brand-500 scale-110; }
        .nav-link.active { @apply bg-indigo-50/80 text-indigo-600 font-semibold relative overflow-hidden; }
        .nav-link.active::after { content: ''; @apply absolute left-0 top-3 bottom-3 w-1 bg-indigo-600 rounded-r-full; }
        .nav-link.active svg { @apply text-indigo-600; }

        /* ── Tables ──────────────────────────────────────────────── */
        .table-row { @apply hover:bg-slate-50/80 transition-colors duration-150 border-b border-slate-100 last:border-0; }
    </style>
</head>
<body class="h-full bg-[#f8fafc] font-sans antialiased text-slate-900">

<div class="flex h-full">

    {{-- ── Sidebar ──────────────────────────────────────────────────────── --}}
    <aside class="hidden md:flex md:w-64 md:flex-col bg-white border-r border-slate-100 fixed inset-y-0 z-20">
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-7">
            <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-violet-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-200">C</div>
            <div>
                <p class="text-sm font-bold text-slate-900 tracking-tight">CandidatureTracker</p>
                <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest">Workspace</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-4 space-y-1.5 overflow-y-auto">
            <p class="px-3 mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Menu principal</p>
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('candidatures.index') }}"
               class="nav-link {{ request()->routeIs('candidatures.*') && !request()->routeIs('candidatures.archives') ? 'active' : '' }}">
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
        <div class="px-4 py-4 border-t border-slate-50">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 transition-colors group">
                <div class="w-9 h-9 bg-gradient-to-tr from-slate-100 to-slate-200 rounded-full flex items-center justify-center text-slate-700 font-semibold text-sm border border-slate-200">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-slate-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-rose-500 transition-colors p-1" title="Déconnexion">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <header class="bg-white/70 backdrop-blur-xl sticky top-0 z-10 border-b border-slate-100/60 px-8 py-5 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-3">
                @yield('page-actions')
            </div>
        </header>

        {{-- Flash messages --}}
        <div class="px-8 mt-6">
            @if(session('success'))
                <div class="flex items-center gap-3 bg-emerald-50/50 border border-emerald-100 text-emerald-800 px-4 py-3.5 rounded-2xl text-sm animate-in fade-in slide-in-from-top-4 duration-500" role="alert">
                    <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 flex-shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center gap-3 bg-rose-50/50 border border-rose-100 text-rose-800 px-4 py-3.5 rounded-2xl text-sm animate-in fade-in slide-in-from-top-4 duration-500" role="alert">
                    <div class="w-8 h-8 bg-rose-100 rounded-xl flex items-center justify-center text-rose-600 flex-shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        {{-- Page content --}}
        <div class="flex-1 px-8 py-8">
            @yield('content')
        </div>
    </main>
</div>

</body>
</html>
