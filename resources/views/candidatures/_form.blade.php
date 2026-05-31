<div class="space-y-8">
    {{-- Entreprise & Poste --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-2">
            <label for="entreprise" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Entreprise <span class="text-rose-500">*</span></label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </span>
                <input type="text" id="entreprise" name="entreprise" value="{{ old('entreprise', $candidature->entreprise ?? '') }}" placeholder="Ex: Google, Microsoft, Startup..." 
                       class="w-full bg-slate-50 border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all {{ $errors->has('entreprise') ? 'ring-2 ring-rose-500/20 bg-rose-50' : '' }}">
            </div>
            @error('entreprise') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-2">
            <label for="poste" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Poste Visé <span class="text-rose-500">*</span></label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </span>
                <input type="text" id="poste" name="poste" value="{{ old('poste', $candidature->poste ?? '') }}" placeholder="Ex: Développeur Fullstack, Product Manager..." 
                       class="w-full bg-slate-50 border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all {{ $errors->has('poste') ? 'ring-2 ring-rose-500/20 bg-rose-50' : '' }}">
            </div>
            @error('poste') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- URL & Date --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-2">
            <label for="url_offre" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Lien de l'offre</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </span>
                <input type="url" id="url_offre" name="url_offre" value="{{ old('url_offre', $candidature->url_offre ?? '') }}" placeholder="https://linkedin.com/jobs/..." 
                       class="w-full bg-slate-50 border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all">
            </div>
            @error('url_offre') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-2">
            <label for="date_candidature" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Date d'envoi <span class="text-rose-500">*</span></label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </span>
                <input type="date" id="date_candidature" name="date_candidature" value="{{ old('date_candidature', isset($candidature) ? $candidature->date_candidature?->format('Y-m-d') : date('Y-m-d')) }}" 
                       class="w-full bg-slate-50 border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all {{ $errors->has('date_candidature') ? 'ring-2 ring-rose-500/20 bg-rose-50' : '' }}">
            </div>
            @error('date_candidature') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Statut & Priorité --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-2">
            <label for="statut" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Statut Actuel <span class="text-rose-500">*</span></label>
            <select id="statut" name="statut" class="w-full bg-slate-50 border-none rounded-2xl py-3.5 px-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all appearance-none {{ $errors->has('statut') ? 'ring-2 ring-rose-500/20 bg-rose-50' : '' }}">
                <option value="">Sélectionner un statut</option>
                @foreach($statuts as $value => $label)
                    <option value="{{ $value }}" {{ old('statut', $candidature->statut?->value ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('statut') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-2">
            <label for="priorite" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Niveau de Priorité <span class="text-rose-500">*</span></label>
            <select id="priorite" name="priorite" class="w-full bg-slate-50 border-none rounded-2xl py-3.5 px-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all appearance-none {{ $errors->has('priorite') ? 'ring-2 ring-rose-500/20 bg-rose-50' : '' }}">
                <option value="">Sélectionner une priorité</option>
                @foreach($priorites as $value => $label)
                    <option value="{{ $value }}" {{ old('priorite', $candidature->priorite?->value ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('priorite') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Notes --}}
    <div class="space-y-2">
        <label for="notes" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Notes & Observations</label>
        <textarea id="notes" name="notes" rows="5" placeholder="Détails importants, noms des recruteurs, points à aborder..." 
                  class="w-full bg-slate-50 border-none rounded-3xl py-4 px-5 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all resize-none">{{ old('notes', $candidature->notes ?? '') }}</textarea>
        @error('notes') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
    </div>

    {{-- File Upload --}}
    <div class="space-y-2">
        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Document (CV, Lettre...)</label>
        <div class="relative group">
            <input type="file" id="fichier" name="fichier" class="hidden" accept=".pdf,.doc,.docx">
            <label for="fichier" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 rounded-3xl bg-slate-50/50 hover:bg-white hover:border-primary-400 cursor-pointer transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-slate-400 group-hover:text-primary-500 group-hover:scale-110 transition-all mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                </div>
                <p class="text-sm font-bold text-slate-600">Charger un document</p>
                <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mt-1">PDF, DOC, DOCX (Max 5Mo)</p>
            </label>
        </div>
        @if(isset($candidature) && $candidature->cv_path)
            <div class="flex items-center gap-2 mt-3 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-xs font-bold border border-emerald-100 w-fit">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Document actuel conservé
            </div>
        @endif
        @error('fichier') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
    </div>
</div>
