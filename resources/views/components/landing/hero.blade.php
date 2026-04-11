{{-- ============================================================
     HERO SECTION — Elegan + Responsif
     ============================================================ --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-gray-950">

    {{-- Animated Gradient Background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-1/4 -left-1/4 w-3/4 h-3/4 rounded-full bg-indigo-600/20 blur-[120px] animate-pulse" style="animation-duration:6s"></div>
        <div class="absolute -bottom-1/4 -right-1/4 w-3/4 h-3/4 rounded-full bg-violet-600/15 blur-[120px] animate-pulse" style="animation-duration:8s;animation-delay:2s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-1/2 h-1/2 rounded-full bg-cyan-600/10 blur-[100px] animate-pulse" style="animation-duration:5s;animation-delay:1s"></div>
    </div>

    {{-- Grid Pattern Overlay --}}
    <div class="absolute inset-0 opacity-[0.03]"
         style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 60px 60px;">
    </div>

    {{-- Content --}}
    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 py-24 lg:py-32 flex flex-col lg:flex-row items-center gap-16">

        {{-- Left: Text --}}
        <div class="flex-1 text-center lg:text-left">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 text-xs font-semibold px-4 py-1.5 rounded-full mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Kampus Terbaik Pilihan Generasi Z
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white leading-tight mb-6">
                Wujudkan <br class="hidden sm:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-violet-400 to-cyan-400">
                    Impianmu
                </span><br class="hidden sm:block">
                Bersama Kami
            </h1>

            <p class="text-gray-400 text-lg leading-relaxed mb-10 max-w-xl mx-auto lg:mx-0">
                KampusKu menghadirkan pendidikan berkualitas tinggi yang menghasilkan
                lulusan inovatif, berkarakter, dan siap bersaing di era global.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-base shadow-[0_0_30px_rgba(99,102,241,0.4)] hover:shadow-[0_0_40px_rgba(99,102,241,0.6)] hover:-translate-y-0.5 transition-all duration-300 group">
                    Daftar Sekarang
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                <a href="{{ route('fakultas.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl border border-gray-700 hover:border-indigo-500/50 text-gray-300 hover:text-white font-semibold text-base bg-white/5 hover:bg-white/10 backdrop-blur-sm transition-all duration-300">
                    Jelajahi Fakultas
                </a>
            </div>

            {{-- Stats --}}
            <div class="mt-14 flex flex-wrap gap-8 justify-center lg:justify-start">
                @php
                    $stats = [
                        ['value' => '5.000+', 'label' => 'Mahasiswa Aktif'],
                        ['value' => '200+',   'label' => 'Dosen Berpengalaman'],
                        ['value' => '12',     'label' => 'Program Studi'],
                    ];
                @endphp
                @foreach($stats as $s)
                <div class="text-center lg:text-left">
                    <p class="text-3xl font-extrabold text-white">{{ $s['value'] }}</p>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $s['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Right: Visual Card --}}
        <div class="flex-1 w-full max-w-md lg:max-w-lg">
            <div class="relative">
                {{-- Main card --}}
                <div class="relative bg-gray-900/60 backdrop-blur-xl border border-gray-700/60 rounded-3xl p-8 shadow-2xl">
                    {{-- Top chips --}}
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-3 h-3 rounded-full bg-red-400"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                        <span class="w-3 h-3 rounded-full bg-green-400"></span>
                        <span class="ml-2 text-xs text-gray-500">Sistem Akademik KampusKu</span>
                    </div>

                    {{-- Notification cards --}}
                    <div class="space-y-3">
                        @php
                            $cards = [
                                ['icon' => '🎓', 'title' => 'Pendaftaran Dibuka', 'sub' => 'Tahun Akademik 2025/2026', 'color' => 'from-indigo-500/20 to-violet-500/20', 'border' => 'border-indigo-500/30'],
                                ['icon' => '📚', 'title' => 'Jadwal Akademik',    'sub' => 'Semester Genap Tersedia',    'color' => 'from-cyan-500/20 to-blue-500/20',   'border' => 'border-cyan-500/30'],
                                ['icon' => '🏆', 'title' => 'Prestasi Terbaru',   'sub' => 'Juara Nasional Olimpiade IT', 'color' => 'from-amber-500/20 to-orange-500/20','border' => 'border-amber-500/30'],
                                ['icon' => '🤖', 'title' => 'FuzanAI Aktif',      'sub' => 'Tanya info kampus 24 jam',    'color' => 'from-violet-500/20 to-pink-500/20', 'border' => 'border-violet-500/30'],
                            ];
                        @endphp
                        @foreach($cards as $card)
                        <div class="flex items-center gap-4 bg-gradient-to-r {{ $card['color'] }} border {{ $card['border'] }} rounded-xl px-4 py-3 hover:scale-[1.02] transition-transform duration-200">
                            <span class="text-2xl">{{ $card['icon'] }}</span>
                            <div>
                                <p class="text-sm font-semibold text-white">{{ $card['title'] }}</p>
                                <p class="text-xs text-gray-400">{{ $card['sub'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- AI shortcut --}}
                    <a href="{{ route('ai.index') }}" class="mt-6 flex items-center justify-between bg-gradient-to-r from-indigo-600/30 to-violet-600/30 border border-indigo-500/40 rounded-2xl px-5 py-3 group hover:border-indigo-400/60 transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-200">Tanya FuzanAI tentang Kampus</span>
                        </div>
                        <svg class="w-4 h-4 text-indigo-400 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                {{-- Decorative glow --}}
                <div class="absolute -z-10 inset-4 bg-indigo-600/20 blur-2xl rounded-3xl"></div>
            </div>
        </div>

    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce text-gray-600">
        <span class="text-xs font-medium tracking-widest uppercase">Scroll</span>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>