<div class="space-y-1">
    <p class="px-4 mb-3 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Menu Principal</p>
    
    <a href="{{ route('dashboard') }}" 
       class="sidebar-link {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>

    <a href="{{ route('candidatures.index') }}" 
       class="sidebar-link {{ request()->routeIs('candidatures.*') && !request()->routeIs('candidatures.archives') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Candidatures
    </a>

    <a href="{{ route('candidatures.archives') }}" 
       class="sidebar-link {{ request()->routeIs('candidatures.archives') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
        Archives
    </a>
</div>

<div class="space-y-1 mt-8">
    <p class="px-4 mb-3 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Analyses</p>
    
    <a href="{{ route('statistiques') }}" 
       class="sidebar-link {{ request()->routeIs('statistiques') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Statistiques
    </a>

    <a href="#" class="sidebar-link sidebar-link-inactive">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        Entreprises
    </a>
</div>

<div class="space-y-1 mt-8">
    <p class="px-4 mb-3 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Configuration</p>
    
    <a href="#" class="sidebar-link sidebar-link-inactive">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m12 4a2 2 0 100-4m0 4a2 2 0 110-4m-6 0a2 2 0 100 4m0-4a2 2 0 110 4m-6 0h12"/></svg>
        Paramètres
    </a>
</div>
