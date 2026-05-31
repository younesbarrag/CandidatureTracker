<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-flex items-center justify-center px-6 py-3 bg-primary-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:scale-95 focus:outline-none focus:ring-4 focus:ring-primary-500/20 transition-all duration-150 shadow-lg shadow-primary-500/25']) }}>
    {{ $slot }}
</button>
