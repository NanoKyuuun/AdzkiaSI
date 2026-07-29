{{-- ponytail: Simplified navbar, light theme --}}
<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
     :class="scrolled ? 'bg-white/95 backdrop-blur-lg shadow-sm' : 'bg-white'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-neutral-200">

    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <div class="w-8 h-8 rounded-md bg-brand-cyan-700 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <span class="text-neutral-900 font-bold text-lg tracking-tight">AdzkiaSI</span>
        </a>

        <ul class="hidden md:flex items-center gap-1">
            @php
                $navLinks = [
                    ['route' => 'home', 'label' => 'Beranda'],
                    ['route' => 'fakultas.index', 'label' => 'Fakultas'],
                    ['route' => 'program-studi.index', 'label' => 'Program Studi'],
                    ['route' => 'kontak', 'label' => 'Kontak'],
                ];
            @endphp
            @foreach($navLinks as $link)
            <li>
                <a href="{{ route($link['route']) }}"
                   class="relative px-4 py-2 text-sm font-medium rounded-md transition-colors
                          {{ request()->routeIs($link['route']) ? 'text-brand-cyan-700' : 'text-neutral-500 hover:text-neutral-900' }}">
                    {{ $link['label'] }}
                </a>
            </li>
            @endforeach
        </ul>

        <div class="hidden md:flex items-center gap-3">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : '#' }}" class="btn btn-primary">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary">Masuk</a>
            @endauth
        </div>

        <button @click="open = !open" class="md:hidden w-9 h-9 flex flex-col items-center justify-center gap-1.5 rounded-lg hover:bg-neutral-050 transition-colors">
            <span :class="open ? 'rotate-45 translate-y-2' : ''" class="w-5 h-0.5 bg-neutral-700 transition-all duration-300 block"></span>
            <span :class="open ? 'opacity-0' : ''" class="w-5 h-0.5 bg-neutral-700 transition-all duration-300 block"></span>
            <span :class="open ? '-rotate-45 -translate-y-2' : ''" class="w-5 h-0.5 bg-neutral-700 transition-all duration-300 block"></span>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition class="md:hidden bg-white/95 backdrop-blur-lg border-b border-neutral-200 px-6 pb-5 pt-2 space-y-1">
        @foreach($navLinks as $link)
        <a href="{{ route($link['route']) }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs($link['route']) ? 'text-brand-cyan-700 bg-neutral-050' : 'text-neutral-500 hover:text-neutral-900' }}">
            {{ $link['label'] }}
        </a>
        @endforeach
        <div class="pt-3 flex flex-col gap-2 border-t border-neutral-200">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : '#' }}" class="btn btn-primary w-full">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary w-full">Masuk Admin</a>
            @endauth
        </div>
    </div>
</nav>

<div class="h-16"></div>
