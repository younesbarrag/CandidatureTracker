<!DOCTYPE html>
<html lang="fr" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CandidatureTracker — Maîtrisez votre destin professionnel</title>

    {{-- Tailwind & Fonts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                        },
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <style>
        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-indigo-600;
        }
        .bg-grid {
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 32px 32px;
        }
    </style>
</head>
<body class="h-full bg-white font-sans antialiased text-slate-900 overflow-x-hidden">

    {{-- ── Navigation ── --}}
    <nav class="fixed top-0 inset-x-0 z-50 bg-white/70 backdrop-blur-xl border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary-500/30">CT</div>
                <span class="text-slate-900 font-extrabold text-xl tracking-tight">Tracker</span>
            </div>
            
            <div class="hidden md:flex items-center gap-8">
                <a href="#features" class="text-sm font-bold text-slate-500 hover:text-primary-600 transition-colors">Fonctionnalités</a>
                <a href="#stats" class="text-sm font-bold text-slate-500 hover:text-primary-600 transition-colors">Statistiques</a>
                <a href="#pricing" class="text-sm font-bold text-slate-500 hover:text-primary-600 transition-colors">Tarifs</a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-slate-800 transition-all active:scale-95 shadow-lg shadow-slate-200">
                        Mon Dashboard
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-primary-600 transition-colors">Connexion</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-2.5 bg-primary-600 text-white rounded-xl font-bold text-sm hover:bg-primary-700 transition-all active:scale-95 shadow-lg shadow-primary-500/25">
                        Essai gratuit
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ── Hero Section ── --}}
    <section class="relative pt-40 pb-32 overflow-hidden bg-grid">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/50 to-white"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 rounded-full text-primary-600 text-xs font-black uppercase tracking-widest mb-8 border border-primary-100 animate-bounce">
                🚀 Version 2.0 est là !
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tight leading-tight mb-8">
                Ne perdez plus jamais le fil de vos <span class="gradient-text">candidatures</span>.
            </h1>
            
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-slate-500 font-medium mb-12">
                Le dashboard intelligent pour centraliser vos recherches d'emploi, suivre vos entretiens et booster votre taux de réussite.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-primary-600 text-white rounded-2xl font-black text-lg hover:bg-primary-700 transition-all hover:scale-105 active:scale-95 shadow-2xl shadow-primary-500/40">
                    Démarrer gratuitement
                </a>
                <a href="#features" class="w-full sm:w-auto px-10 py-5 bg-white text-slate-700 rounded-2xl font-black text-lg hover:bg-slate-50 border border-slate-200 transition-all active:scale-95 shadow-sm">
                    En savoir plus
                </a>
            </div>
            
            {{-- Dashboard Preview --}}
            <div class="mt-20 relative max-w-5xl mx-auto group">
                <div class="absolute -inset-4 bg-gradient-to-r from-primary-500 to-indigo-500 rounded-[2.5rem] blur-2xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                <div class="relative bg-white rounded-[2rem] shadow-2xl border border-slate-100 overflow-hidden aspect-[16/9]">
                    <div class="h-12 bg-slate-50 flex items-center px-6 gap-2 border-b border-slate-100">
                        <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                    </div>
                    <div class="p-8 flex gap-8 h-full">
                        <div class="w-1/4 space-y-4">
                            <div class="h-8 bg-slate-100 rounded-xl w-3/4"></div>
                            <div class="h-64 bg-slate-50 rounded-2xl"></div>
                        </div>
                        <div class="flex-1 space-y-6">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="h-32 bg-primary-50 rounded-3xl"></div>
                                <div class="h-32 bg-slate-50 rounded-3xl"></div>
                                <div class="h-32 bg-slate-50 rounded-3xl"></div>
                            </div>
                            <div class="h-64 bg-slate-50 rounded-3xl"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Features Section ── --}}
    <section id="features" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight">Tout ce dont vous avez besoin</h2>
                <p class="text-slate-500 font-medium mt-4">Une suite d'outils pensée pour les candidats ambitieux.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="p-10 rounded-[2.5rem] bg-slate-50 hover:bg-white hover:shadow-premium transition-all group border border-transparent hover:border-slate-100">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-primary-600 mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-4">Suivi Centralisé</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        Fini les fichiers Excel interminables. Gérez toutes vos offres au même endroit avec un statut clair et précis.
                    </p>
                </div>

                <div class="p-10 rounded-[2.5rem] bg-slate-50 hover:bg-white hover:shadow-premium transition-all group border border-transparent hover:border-slate-100">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-primary-600 mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-4">Gestion d'Agenda</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        Ne manquez plus aucun rendez-vous. Recevez des notifications pour vos entretiens et préparez-les efficacement.
                    </p>
                </div>

                <div class="p-10 rounded-[2.5rem] bg-slate-50 hover:bg-white hover:shadow-premium transition-all group border border-transparent hover:border-slate-100">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-primary-600 mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-4">Statistiques Avancées</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        Analysez vos performances, identifiez les blocages dans votre tunnel de recrutement et ajustez votre stratégie.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── CTA Section ── --}}
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-primary-600/20 rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-indigo-600/20 rounded-full blur-3xl"></div>
                
                <h2 class="text-3xl md:text-5xl font-black text-white mb-8 relative z-10">Prêt à décrocher le job de vos rêves ?</h2>
                <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto mb-12 relative z-10 font-medium">
                    Rejoignez des milliers de candidats qui utilisent CandidatureTracker pour optimiser leur recherche d'emploi.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-white text-slate-900 rounded-2xl font-black text-lg hover:bg-slate-100 transition-all active:scale-95 shadow-xl">
                        Créer mon compte
                    </a>
                    <a href="{{ route('login') }}" class="text-white font-bold hover:text-primary-400 transition-colors">Déjà inscrit ? Connectez-vous</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Footer ── --}}
    <footer class="bg-white py-12 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center text-white font-bold text-lg">CT</div>
                <span class="text-slate-900 font-extrabold text-lg tracking-tight">Tracker</span>
            </div>
            
            <p class="text-slate-400 text-sm font-medium">© 2026 CandidatureTracker. Fait avec passion pour les candidats.</p>
            
            <div class="flex items-center gap-6">
                <a href="#" class="text-slate-400 hover:text-primary-600 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                <a href="#" class="text-slate-400 hover:text-primary-600 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.999v-2.846c0-.777-.329-1.077-.726-1.077-.367 0-.765.23-.765 1.077v2.846h-2v-6h2v.838c.271-.451.765-.838 1.581-.838 1.409 0 1.909 1.038 1.909 2.57v3.43z"/></svg></a>
            </div>
        </div>
    </footer>

</body>
</html>
