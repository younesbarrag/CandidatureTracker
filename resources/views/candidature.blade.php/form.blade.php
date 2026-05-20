{{--
    Partial réutilisable pour le formulaire candidature.
    Utilisé dans create.blade.php ET edit.blade.php.
    
    Variables disponibles :
    - $candidature (null pour create, model pour edit)
    - $statuts (array [value => label])
    - $priorites (array [value => label])
--}}

{{-- Entreprise --}}
<div>
    <label for="entreprise" class="block text-sm font-medium text-gray-700 mb-1">
        Entreprise <span class="text-red-500">*</span>
    </label>
    <input type="text" id="entreprise" name="entreprise"
           value="{{ old('entreprise', $candidature->entreprise ?? '') }}"
           placeholder="Ex : Google, Startup XYZ..."
           class="input {{ $errors->has('entreprise') ? 'input-error' : '' }}">
    @error('entreprise')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Poste --}}
<div>
    <label for="poste" class="block text-sm font-medium text-gray-700 mb-1">
        Poste visé <span class="text-red-500">*</span>
    </label>
    <input type="text" id="poste" name="poste"
           value="{{ old('poste', $candidature->poste ?? '') }}"
           placeholder="Ex : Développeur Full Stack, Chef de projet..."
           class="input {{ $errors->has('poste') ? 'input-error' : '' }}">
    @error('poste')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- URL de l'offre --}}
<div>
    <label for="url_offre" class="block text-sm font-medium text-gray-700 mb-1">
        URL de l'offre
        <span class="text-gray-400 font-normal">(optionnel)</span>
    </label>
    <input type="url" id="url_offre" name="url_offre"
           value="{{ old('url_offre', $candidature->url_offre ?? '') }}"
           placeholder="https://..."
           class="input {{ $errors->has('url_offre') ? 'input-error' : '' }}">
    @error('url_offre')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Statut + Priorité côte à côte --}}
<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">
            Statut <span class="text-red-500">*</span>
        </label>
        <select id="statut" name="statut"
                class="input {{ $errors->has('statut') ? 'input-error' : '' }}">
            <option value="">Choisir…</option>
            @foreach($statuts as $value => $label)
                <option value="{{ $value }}"
                    {{ old('statut', $candidature->statut?->value ?? '') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('statut')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="priorite" class="block text-sm font-medium text-gray-700 mb-1">
            Priorité <span class="text-red-500">*</span>
        </label>
        <select id="priorite" name="priorite"
                class="input {{ $errors->has('priorite') ? 'input-error' : '' }}">
            <option value="">Choisir…</option>
            @foreach($priorites as $value => $label)
                <option value="{{ $value }}"
                    {{ old('priorite', $candidature->priorite?->value ?? '') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('priorite')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Date de candidature --}}
<div>
    <label for="date_candidature" class="block text-sm font-medium text-gray-700 mb-1">
        Date de candidature <span class="text-red-500">*</span>
    </label>
    <input type="date" id="date_candidature" name="date_candidature"
           value="{{ old('date_candidature', isset($candidature) ? $candidature->date_candidature?->format('Y-m-d') : date('Y-m-d')) }}"
           max="{{ date('Y-m-d') }}"
           class="input {{ $errors->has('date_candidature') ? 'input-error' : '' }}">
    @error('date_candidature')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Notes --}}
<div>
    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
        Notes <span class="text-gray-400 font-normal">(optionnel)</span>
    </label>
    <textarea id="notes" name="notes" rows="4"
              placeholder="Informations sur le poste, contact, conditions…"
              class="input resize-none {{ $errors->has('notes') ? 'input-error' : '' }}">{{ old('notes', $candidature->notes ?? '') }}</textarea>
    @error('notes')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Fichier --}}
<div>
    <label for="fichier" class="block text-sm font-medium text-gray-700 mb-1">
        Document (CV, lettre…) <span class="text-gray-400 font-normal">(PDF ou Word, max 5 Mo)</span>
    </label>
    @if(isset($candidature) && $candidature->fichier)
        <div class="mb-2 flex items-center gap-2 text-sm text-gray-600 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5">
            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Fichier actuel : <span class="font-medium">{{ basename($candidature->fichier) }}</span>
            <span class="text-gray-400">(remplacer ci-dessous)</span>
        </div>
    @endif
    <input type="file" id="fichier" name="fichier" accept=".pdf,.doc,.docx"
           class="input file:mr-3 file:btn file:btn-secondary file:border-0 file:cursor-pointer
                  {{ $errors->has('fichier') ? 'input-error' : '' }}">
    @error('fichier')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
