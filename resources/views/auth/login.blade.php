<x-guest-layout>
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Content de vous revoir !</h2>
        <p class="text-slate-500 font-medium mt-1">Connectez-vous pour suivre vos candidatures.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Adresse Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="votre@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="Mot de passe" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-primary-600 hover:text-primary-700 transition-colors" href="{{ route('password.request') }}">
                        Oublié ?
                    </a>
                @endif
            </div>

            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500 shadow-sm" name="remember">
            <label for="remember_me" class="ms-2 text-sm font-bold text-slate-600 cursor-pointer">Rester connecté</label>
        </div>

        <div class="pt-2">
            <x-primary-button>
                Se connecter
            </x-primary-button>
        </div>

        <p class="text-center text-sm font-bold text-slate-500">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-700 transition-colors underline decoration-2 underline-offset-4">Inscrivez-vous</a>
        </p>
    </form>
</x-guest-layout>
