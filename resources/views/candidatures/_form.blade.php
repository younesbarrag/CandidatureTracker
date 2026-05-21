{{--
    Partial réutilisable pour le formulaire candidature.
    Utilisé dans create.blade.php ET edit.blade.php.
--}}

<div class="space-y-6">
    {{-- Entreprise & Poste --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="entreprise" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Entreprise <span class="text-red-500">*</span>
            </label>
            <input type="text" id="entreprise" name="entreprise"
                   value="{{ old('entreprise', $candidature->entreprise ?? '') }}"
                   placeholder="Google, Startup XYZ..."
                   class="input {{ $errors->has('entreprise') ? 'border-red-300 bg-red-50' : '' }}">
            @error('entreprise')
                <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="poste" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Poste visé <span class="text-red-500">*</span>
            </label>
            <input type="text" id="poste" name="poste"
                   value="{{ old('poste', $candidature->poste ?? '') }}"
                   placeholder="Développeur, Manager..."
                   class="input {{ $errors->has('poste') ? 'border-red-300 bg-red-50' : '' }}">
            @error('poste')
                <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- URL de l'offre --}}
    <div>
        <label for="url_offre" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            Lien de l'offre <span class="text-gray-400 font-normal lowercase italic">(optionnel)</span>
        </label>
        <input type="url" id="url_offre" name="url_offre"
               value="{{ old('url_offre', $candidature->url_offre ?? '') }}"
               placeholder="https://..."
               class="input {{ $errors->has('url_offre') ? 'border-red-300 bg-red-50' : '' }}">
        @error('url_offre')
            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Statut + Priorité --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <label for="statut" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">
                Statut actuel <span class="text-red-500">*</span>
            </label>
            <select id="statut" name="statut"
                    class="input {{ $errors->has('statut') ? 'border-red-300 bg-red-50' : '' }}">
                <option value="">Sélectionner...</option>
                @foreach($statuts as $value => $label)
                    <option value="{{ $value }}"
                        {{ old('statut', $candidature->statut?->value ?? '') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('statut')
                <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="priorite" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">
                Niveau de priorité <span class="text-red-500">*</span>
            </label>
            <select id="priorite" name="priorite"
                    class="input {{ $errors->has('priorite') ? 'border-red-300 bg-red-50' : '' }}">
                <option value="">Sélectionner...</option>
                @foreach($priorites as $value => $label)
                    <option value="{{ $value }}"
                        {{ old('priorite', $candidature->priorite?->value ?? '') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('priorite')
                <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Date de candidature --}}
    <div>
        <label for="date_candidature" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Date d'envoi <span class="text-red-500">*</span>
        </label>
        <input type="date" id="date_candidature" name="date_candidature"
               value="{{ old('date_candidature', isset($candidature) ? $candidature->date_candidature?->format('Y-m-d') : date('Y-m-d')) }}"
               max="{{ date('Y-m-d') }}"
               class="input {{ $errors->has('date_candidature') ? 'border-red-300 bg-red-50' : '' }}">
        @error('date_candidature')
            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Notes --}}
    <div>
        <label for="notes" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">
            Description & Notes personelles
        </label>
        <textarea id="notes" name="notes" rows="4"
                  placeholder="Points clés du poste, contacts, relances prévues..."
                  class="input resize-none {{ $errors->has('notes') ? 'border-red-300 bg-red-50' : '' }}">{{ old('notes', $candidature->notes ?? '') }}</textarea>
        @error('notes')
            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Fichier --}}
    <div>
        <label for="fichier" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
            Curriculum Vitae / Document
        </label>
        
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-100 border-dashed rounded-2xl hover:border-brand-300 hover:bg-brand-50/30 transition-all group">
            <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-brand-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-sm text-gray-600">
                    <label for="fichier" class="relative cursor-pointer bg-white rounded-md font-bold text-brand-600 hover:text-brand-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand-500 transition-colors">
                        <span>Charger un fichier</span>
                        <input id="fichier" name="fichier" type="file" class="sr-only" accept=".pdf,.doc,.docx">
                    </label>
                    <p class="pl-1">ou glisser-déposer</p>
                </div>
                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-tighter">
                    PDF, DOC, DOCX jusqu'à 5 Mo
                </p>
                @if(isset($candidature) && $candidature->cv_path)
                    <p class="text-xs text-brand-600 font-bold mt-2 flex items-center justify-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Fichier déjà présent
                    </p>
                @endif
            </div>
        </div>
        
        @error('fichier')
            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>
</div>
