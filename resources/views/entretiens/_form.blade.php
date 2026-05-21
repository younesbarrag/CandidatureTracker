{{--
    Partial réutilisable pour le formulaire entretien.
    Variables : $entretien (null pour create), $types, $resultats
--}}

<div class="space-y-6">
    {{-- Type d'entretien --}}
    <div>
        <label for="type" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            Type de rendez-vous <span class="text-red-500">*</span>
        </label>
        <select id="type" name="type"
                class="input {{ $errors->has('type') ? 'border-red-300 bg-red-50' : '' }}">
            <option value="">Sélectionner le format...</option>
            @foreach($types as $value => $label)
                <option value="{{ $value }}"
                    {{ old('type', $entretien->type?->value ?? '') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('type')
            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Date et heure --}}
    <div>
        <label for="date_heure" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Date & Heure du rendez-vous <span class="text-red-500">*</span>
        </label>
        <input type="datetime-local" id="date_heure" name="date_heure"
               value="{{ old('date_heure', isset($entretien) ? $entretien->date_heure?->format('Y-m-d\TH:i') : '') }}"
               class="input {{ $errors->has('date_heure') ? 'border-red-300 bg-red-50' : '' }}">
        @error('date_heure')
            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Résultat --}}
    <div>
        <label for="resultat" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Statut du résultat <span class="text-red-500">*</span>
        </label>
        <div class="grid grid-cols-2 gap-3">
            @foreach($resultats as $value => $label)
                <label class="relative flex items-center justify-center p-3 rounded-xl border border-gray-100 bg-gray-50 cursor-pointer hover:bg-white hover:border-brand-200 transition-all group">
                    <input type="radio" name="resultat" value="{{ $value }}" class="sr-only" 
                           {{ old('resultat', $entretien->resultat?->value ?? 'en_attente') === $value ? 'checked' : '' }}>
                    <span class="text-xs font-bold text-gray-500 group-hover:text-brand-600 transition-colors selection-checked:text-brand-700">
                        {{ $label }}
                    </span>
                    <div class="absolute inset-0 rounded-xl border-2 border-brand-500 opacity-0 transition-opacity pointer-events-none input-checked:opacity-100"></div>
                </label>
            @endforeach
        </div>
        <style>
            input[type="radio"]:checked + span { @apply text-brand-700; }
            input[type="radio"]:checked ~ div { @apply opacity-100; }
        </style>
        @error('resultat')
            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Notes de préparation --}}
    <div>
        <label for="notes_preparation" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            Préparation & Notes
        </label>
        <textarea id="notes_preparation" name="notes_preparation" rows="5"
                  placeholder="Points clés à aborder, questions à poser, recherches effectuées..."
                  class="input resize-none {{ $errors->has('notes_preparation') ? 'border-red-300 bg-red-50' : '' }}">{{ old('notes_preparation', $entretien->notes_preparation ?? '') }}</textarea>
        @error('notes_preparation')
            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>
</div>
