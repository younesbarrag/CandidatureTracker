@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-slate-50 border-none rounded-2xl py-3 px-4 text-sm focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all shadow-sm placeholder-slate-400']) }}>
