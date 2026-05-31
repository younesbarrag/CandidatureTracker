<div class="space-y-8">
    {{-- Type d'entretien --}}
    <div class="space-y-2">
        <label for="type" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Type de Rendez-vous <span class="text-rose-500">*</span></label>
        <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </span>
            <select id="type" name="type" class="w-full bg-slate-50 border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all appearance-none {{ $errors->has('type') ? 'ring-2 ring-rose-500/20 bg-rose-50' : '' }}">
                <option value="">Sélectionner le format...</option>
                @foreach($types as $value => $label)
                    <option value="{{ $value }}" {{ old('type', $entretien->type?->value ?? '') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        @error('type') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
    </div>

    {{-- Date et heure --}}
    <div class="space-y-2">
        <label for="date_heure" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Date & Heure <span class="text-rose-500">*</span></label>
        <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
            <input type="datetime-local" id="date_heure" name="date_heure" value="{{ old('date_heure', isset($entretien) ? $entretien->date_heure?->format('Y-m-d\TH:i') : '') }}" 
                   class="w-full bg-slate-50 border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all {{ $errors->has('date_heure') ? 'ring-2 ring-rose-500/20 bg-rose-50' : '' }}">
        </div>
        @error('date_heure') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
    </div>

    {{-- Résultat --}}
    <div class="space-y-4">
        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Résultat / Statut <span class="text-rose-500">*</span></label>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($resultats as $value => $label)
                <label class="relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 border-slate-100 bg-slate-50 cursor-pointer hover:bg-white hover:border-primary-200 transition-all group">
                    <input type="radio" name="resultat" value="{{ $value }}" class="sr-only peer" {{ old('resultat', $entretien->resultat?->value ?? 'attente') === $value ? 'checked' : '' }}>
                    <span class="text-xs font-black text-slate-500 peer-checked:text-primary-600 uppercase tracking-widest transition-colors">{{ $label }}</span>
                    <div class="absolute inset-0 rounded-2xl border-2 border-primary-500 opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none ring-4 ring-primary-500/5"></div>
                </label>
            @endforeach
        </div>
        @error('resultat') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
    </div>

    {{-- Notes --}}
    <div class="space-y-2">
        <label for="notes_preparation" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Notes & Préparation</label>
        <textarea id="notes_preparation" name="notes_preparation" rows="5" placeholder="Questions à poser, points clés, débriefing..." 
                  class="w-full bg-slate-50 border-none rounded-3xl py-4 px-5 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all resize-none">{{ old('notes_preparation', $entretien->notes_preparation ?? '') }}</textarea>
        @error('notes_preparation') <p class="text-xs text-rose-600 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
    </div>
</div>
