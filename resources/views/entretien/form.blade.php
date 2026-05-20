{{--
    Partial réutilisable pour le formulaire entretien.
    Variables : $entretien (null pour create), $types, $resultats
--}}

{{-- Type d'entretien --}}
<div>
    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
        Type d'entretien <span class="text-red-500">*</span>
    </label>
    <select id="type" name="type"
            class="input {{ $errors->has('type') ? 'input-error' : '' }}">
        <option value="">Choisir un type…</option>
        @foreach($types as $value => $label)
            <option value="{{ $value }}"
                {{ old('type', $entretien->type?->value ?? '') === $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('type')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Date et heure --}}
<div>
    <label for="date_heure" class="block text-sm font-medium text-gray-700 mb-1">
        Date et heure <span class="text-red-500">*</span>
    </label>
    <input type="datetime-local" id="date_heure" name="date_heure"
           value="{{ old('date_heure', isset($entretien) ? $entretien->date_heure?->format('Y-m-d\TH:i') : '') }}"
           class="input {{ $errors->has('date_heure') ? 'input-error' : '' }}">
    @error('date_heure')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Résultat --}}
<div>
    <label for="resultat" class="block text-sm font-medium text-gray-700 mb-1">
        Résultat <span class="text-red-500">*</span>
    </label>
    <select id="resultat" name="resultat"
            class="input {{ $errors->has('resultat') ? 'input-error' : '' }}">
        @foreach($resultats as $value => $label)
            <option value="{{ $value }}"
                {{ old('resultat', $entretien->resultat?->value ?? 'en_attente') === $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('resultat')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Notes de préparation --}}
<div>
    <label for="notes_preparation" class="block text-sm font-medium text-gray-700 mb-1">
        Notes de préparation <span class="text-gray-400 font-normal">(optionnel)</span>
    </label>
    <textarea id="notes_preparation" name="notes_preparation" rows="5"
              placeholder="Questions préparées, points à aborder, recherches sur l'entreprise…"
              class="input resize-none {{ $errors->has('notes_preparation') ? 'input-error' : '' }}">{{ old('notes_preparation', $entretien->notes_preparation ?? '') }}</textarea>
    @error('notes_preparation')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
