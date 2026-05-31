<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Authentification — CandidatureTracker</title>

    {{-- Tailwind & Fonts --}}
    <script src="https://cdn.tailwindcss.com"></script>
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
                        },
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="h-full bg-slate-50 font-sans antialiased text-slate-900">

    <div class="min-h-full flex flex-col md:flex-row">
        {{-- ── Left Side: Form ── --}}
        <div class="flex-1 flex flex-col justify-center py-12 px-6 sm:px-12 lg:flex-none lg:w-[480px] bg-white shadow-2xl relative z-10">
            <div class="mx-auto w-full max-w-sm">
                <div class="mb-10">
                    <a href="/" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">CT</div>
                        <span class="text-slate-900 font-extrabold text-xl tracking-tight">Tracker</span>
                    </a>
                </div>

                {{ $slot }}
            </div>
        </div>

        {{-- ── Right Side: Design/Quote ── --}}
        <div class="hidden lg:block relative flex-1 bg-slate-900">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600/40 to-indigo-900/60 mix-blend-multiply"></div>
            <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Workspace" class="absolute inset-0 w-full h-full object-cover">
            
            <div class="absolute inset-0 flex flex-col justify-end p-20 text-white">
                <div class="max-w-xl">
                    <div class="w-12 h-1 bg-primary-500 mb-8 rounded-full"></div>
                    <h2 class="text-4xl font-black mb-6 leading-tight">"La meilleure façon de prédire l'avenir est de le créer."</h2>
                    <p class="text-lg text-slate-300 font-medium">— Peter Drucker</p>
                </div>
            </div>
            
            {{-- Floating Decorative Elements --}}
            <div class="absolute top-20 right-20 w-64 h-64 bg-primary-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-40 right-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
        </div>
    </div>

</body>
</html>
