{{-- Navbar Dark Elegan — selaras dengan hero --}}
<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
     :class="scrolled ? 'bg-gray-950/95 backdrop-blur-xl shadow-lg shadow-black/20 border-b border-gray-800/60' : 'bg-transparent'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-md shadow-indigo-900/50 group-hover:scale-105 transition-transform">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <span class="text-white font-bold text-lg tracking-tight">KampusKu</span>
        </a>

        {{-- Desktop Menu --}}
        <ul class="hidden md:flex items-center gap-1">
            @php
                $navLinks = [
                    ['route' => 'home',              'label' => 'Beranda'],
                    ['route' => 'fakultas.index',    'label' => 'Fakultas'],
                    ['route' => 'program-studi.index','label' => 'Program Studi'],
                    ['route' => 'kontak',            'label' => 'Kontak'],
                ];
            @endphp
            @foreach($navLinks as $link)
            <li>
                <a href="{{ route($link['route']) }}"
                   class="relative px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                          {{ request()->routeIs($link['route'])
                              ? 'text-white bg-indigo-500/15 border border-indigo-500/30'
                              : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    {{ $link['label'] }}
                </a>
            </li>
            @endforeach
        </ul>

        {{-- Desktop Auth Buttons --}}
        <div class="hidden md:flex items-center gap-3">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : '#' }}"
                   class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold transition-colors shadow-md shadow-indigo-900/40">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 rounded-lg border border-red-500/30 text-red-400 hover:bg-red-500/10 hover:text-red-300 text-sm font-medium transition-colors">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-lg border border-gray-700 text-gray-300 hover:text-white hover:border-gray-500 text-sm font-medium transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-2 rounded-lg bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold transition-all shadow-md shadow-indigo-900/40">
                    Daftar
                </a>
            @endauth
        </div>

        {{-- Mobile Hamburger --}}
        <button @click="open = !open"
                class="md:hidden w-9 h-9 flex flex-col items-center justify-center gap-1.5 rounded-lg hover:bg-white/5 transition-colors">
            <span :class="open ? 'rotate-45 translate-y-2' : ''" class="w-5 h-0.5 bg-gray-400 transition-all duration-300 block"></span>
            <span :class="open ? 'opacity-0' : ''" class="w-5 h-0.5 bg-gray-400 transition-all duration-300 block"></span>
            <span :class="open ? '-rotate-45 -translate-y-2' : ''" class="w-5 h-0.5 bg-gray-400 transition-all duration-300 block"></span>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-gray-950/98 backdrop-blur-xl border-b border-gray-800 px-6 pb-5 pt-2 space-y-1">
        @foreach($navLinks as $link)
        <a href="{{ route($link['route']) }}"
           class="block px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                  {{ request()->routeIs($link['route'])
                      ? 'text-white bg-indigo-500/15 border border-indigo-500/30'
                      : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            {{ $link['label'] }}
        </a>
        @endforeach
        <div class="pt-3 flex flex-col gap-2 border-t border-gray-800">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : '#' }}"
                   class="block text-center px-4 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-semibold">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2.5 rounded-lg border border-red-500/30 text-red-400 text-sm font-medium">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="block text-center px-4 py-2.5 rounded-lg border border-gray-700 text-gray-300 text-sm font-medium">Masuk</a>
                <a href="{{ route('register') }}"
                   class="block text-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-sm font-semibold">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

{{-- Spacer agar konten tidak tertutup navbar fixed --}}
<div class="h-0"></div>
