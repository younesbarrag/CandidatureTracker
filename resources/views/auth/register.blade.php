<x-guest-layout>
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Rejoignez-nous !</h2>
        <p class="text-slate-500 font-medium mt-1">Créez votre compte en quelques secondes.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nom Complet" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Adresse Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="votre@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="pt-2">
            <x-primary-button>
                Créer mon compte
            </x-primary-button>
        </div>

        <p class="text-center text-sm font-bold text-slate-500">
            Déjà inscrit ? 
            <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 transition-colors underline decoration-2 underline-offset-4">Connectez-vous</a>
        </p>
    </form>
</x-guest-layout>
