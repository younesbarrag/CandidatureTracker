<!DOCTYPE html>
<html lang="fr" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — CandidatureTracker</title>

    {{-- Tailwind & Fonts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                            950: '#2e1065',
                        },
                        secondary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                        dark: {
                            sidebar: '#0f172a',
                            nav: '#1e293b'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        'premium': '0 10px 40px -10px rgba(0,0,0,0.05)',
                        'premium-hover': '0 20px 50px -12px rgba(0,0,0,0.1)',
                        'glass': 'inset 0 0 0 1px rgba(255, 255, 255, 0.1)',
                    },
                    borderRadius: {
                        '2xl': '16px',
                        '3xl': '24px',
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .sidebar-link {
            @apply flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200;
        }
        .sidebar-link-active {
            @apply bg-primary-600/10 text-primary-400 font-semibold shadow-sm;
        }
        .sidebar-link-inactive {
            @apply text-slate-400 hover:bg-white/5 hover:text-white;
        }

        .btn-premium {
            @apply inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl font-bold text-sm transition-all duration-300 active:scale-95 shadow-lg;
        }
        .btn-primary {
            @apply btn-premium bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-primary-500/25 hover:shadow-primary-500/40 hover:-translate-y-0.5;
        }
        .btn-secondary {
            @apply btn-premium bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 shadow-sm;
        }

        .badge-modern {
            @apply inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>
</head>
<body class="h-full bg-[#FAFBFF] font-sans antialiased text-slate-900 overflow-hidden" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar for Mobile --}}
        <div x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden" x-cloak>
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="sidebarOpen = false"></div>
            <div class="fixed inset-y-0 left-0 w-72 bg-dark-sidebar flex flex-col z-50 transition-transform duration-300">
                <div class="flex items-center justify-between px-6 py-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary-500/30">CT</div>
                        <span class="text-white font-extrabold text-lg tracking-tight">Tracker</span>
                    </div>
                    <button @click="sidebarOpen = false" class="text-slate-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto">
                    {{-- Sidebar links repeated for mobile --}}
                    @include('layouts.sidebar-links')
                </nav>
            </div>
        </div>

        {{-- Sidebar Desktop --}}
        <aside class="hidden lg:flex lg:w-72 lg:flex-col bg-dark-sidebar fixed inset-y-0 z-20">
            <div class="flex items-center gap-3 px-8 py-10">
                <div class="w-11 h-11 bg-gradient-to-br from-primary-600 to-primary-400 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-xl shadow-primary-500/20">CT</div>
                <div>
                    <h1 class="text-white font-extrabold text-xl leading-tight tracking-tight">Candidature</h1>
                    <p class="text-primary-400 text-[10px] font-black uppercase tracking-[0.2em]">Tracker SaaS</p>
                </div>
            </div>

            <nav class="flex-1 px-6 space-y-2 overflow-y-auto custom-scrollbar">
                @include('layouts.sidebar-links')
            </nav>

            <div class="p-6 mt-auto">
                <div class="bg-white/5 rounded-3xl p-5 border border-white/10 relative overflow-hidden group">
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-primary-600/20 rounded-full blur-2xl transition-all group-hover:bg-primary-600/30"></div>
                    <p class="text-white font-bold text-sm mb-1">Besoin d'aide ?</p>
                    <p class="text-slate-400 text-xs mb-4">Consultez notre guide d'utilisation</p>
                    <a href="#" class="inline-flex items-center text-xs font-bold text-primary-400 hover:text-primary-300 transition-colors">
                        Voir la documentation
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <main class="flex-1 lg:ml-72 flex flex-col h-screen overflow-hidden">
            {{-- Top Navbar --}}
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 px-8 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center gap-4 lg:gap-0">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="hidden md:flex items-center bg-slate-100/50 border border-slate-200/60 rounded-2xl px-4 py-2 w-96 group focus-within:bg-white focus-within:ring-4 focus-within:ring-primary-500/5 transition-all">
                        <svg class="w-4 h-4 text-slate-400 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" placeholder="Rechercher une candidature..." class="bg-transparent border-none focus:ring-0 text-sm w-full ml-3 text-slate-600 placeholder-slate-400">
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <button class="relative p-2.5 text-slate-500 hover:bg-slate-100 rounded-2xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                    </button>

                    <div class="h-8 w-px bg-slate-100"></div>

                    <div class="flex items-center gap-3 pl-2 group cursor-pointer" x-data="{ open: false }" @click="open = !open">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-900 leading-none group-hover:text-primary-600 transition-colors">{{ auth()->user()->name }}</p>
                            <p class="text-[11px] font-semibold text-slate-400 mt-1 uppercase tracking-wider">Recruteur</p>
                        </div>
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-primary-600 to-primary-400 p-[2px] shadow-lg shadow-primary-500/20 group-hover:scale-105 transition-all">
                            <div class="w-full h-full rounded-[14px] bg-white flex items-center justify-center text-primary-600 font-bold overflow-hidden">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </div>
                        
                        {{-- Dropdown User --}}
                        <div x-show="open" @click.away="open = false" class="absolute right-8 top-20 w-56 bg-white rounded-3xl shadow-2xl border border-slate-100 py-3 z-50 animate-in fade-in zoom-in duration-200" x-cloak>
                            <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm text-slate-600 hover:bg-slate-50 hover:text-primary-600 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Mon Profil
                            </a>
                            <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm text-slate-600 hover:bg-slate-50 hover:text-primary-600 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Paramètres
                            </a>
                            <div class="h-px bg-slate-100 my-2 mx-5"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-5 py-3 text-sm text-rose-600 hover:bg-rose-50 transition-all font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content Area with Scroll --}}
            <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
                {{-- Flash Notifications --}}
                @if(session('success'))
                    <div class="mb-8 flex items-center gap-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 p-5 rounded-3xl animate-in fade-in slide-in-from-top-4 duration-500" role="alert">
                        <div class="w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/30 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="font-extrabold text-sm">Succès !</p>
                            <p class="text-sm opacity-90">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-8 flex items-center gap-4 bg-rose-500/10 border border-rose-500/20 text-rose-700 p-5 rounded-3xl animate-in fade-in slide-in-from-top-4 duration-500" role="alert">
                        <div class="w-10 h-10 bg-rose-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-rose-500/30 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <p class="font-extrabold text-sm">Erreur</p>
                            <p class="text-sm opacity-90">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
