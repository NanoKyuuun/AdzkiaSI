<div class="flex flex-col h-full">
    {{-- Brand: h-14, border-b-white/5 --}}
    <div class="flex items-center gap-3 px-4 h-14 flex-shrink-0 border-b border-white/5">
        <div class="w-8 h-8 rounded-md bg-brand-cyan-500 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <span class="text-sm font-bold text-white tracking-tight">{{ config('app.name', 'AdzkiaSI') }}</span>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 overflow-y-auto p-3 space-y-0.5">
        <p class="px-3 py-2 text-[10px] font-semibold text-white/40 uppercase tracking-widest">Menu</p>

        <x-sidebar.link href="{{ route('admin.dashboard') }}" :active="Route::currentRouteName() == 'admin.dashboard'" label="Dashboard">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </x-sidebar.link>

        <p class="px-3 pt-5 pb-2 text-[10px] font-semibold text-white/40 uppercase tracking-widest">Informasi</p>

        <x-sidebar.link href="{{ route('admin.fakultas.index') }}" :active="str_starts_with(Route::currentRouteName(), 'admin.fakultas')" label="Fakultas">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </x-sidebar.link>

        <x-sidebar.link href="{{ route('admin.program-studi.index') }}" :active="str_starts_with(Route::currentRouteName(), 'admin.program-studi')" label="Program Studi">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
        </x-sidebar.link>

        <x-sidebar.link href="{{ route('admin.dosen.index') }}" :active="str_starts_with(Route::currentRouteName(), 'admin.dosen')" label="Dosen">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zm-4 7a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </x-sidebar.link>

        <p class="px-3 pt-5 pb-2 text-[10px] font-semibold text-white/40 uppercase tracking-widest">Sistem</p>

        <x-sidebar.link href="{{ route('admin.users.index') }}" :active="str_starts_with(Route::currentRouteName(), 'admin.users')" label="Admin">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0"/>
        </x-sidebar.link>

        <x-sidebar.link href="{{ route('admin.faq.index') }}" :active="str_starts_with(Route::currentRouteName(), 'admin.faq')" label="FAQ & AI">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
        </x-sidebar.link>
    </nav>

    {{-- Footer --}}
    <div class="p-3 border-t border-white/5 flex-shrink-0">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 rounded-md text-sm text-white/50 hover:text-white hover:bg-white/10 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="font-medium">Keluar</span>
            </button>
        </form>
    </div>
</div>
