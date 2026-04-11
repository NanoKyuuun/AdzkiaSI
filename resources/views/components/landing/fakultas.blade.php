{{-- ============================================================
     FAKULTAS SECTION COMPONENT — Elegan dark theme
     Menampilkan preview 3 fakultas, link ke halaman lengkap
     ============================================================ --}}
<section class="py-24 px-6 bg-gray-900/50 relative overflow-hidden">

    {{-- Accent line top --}}
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-indigo-500/30 to-transparent"></div>

    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                </svg>
                Pilihan Terbaik
            </div>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-4">
                Fakultas <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Unggulan</span>
            </h2>
            <p class="text-gray-500 max-w-lg mx-auto">
                Temukan jalur pendidikan yang sesuai dengan passion dan tujuan karir Anda.
            </p>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $fakPreview = [
                    [
                        'nama'  => 'Teknik',
                        'desc'  => 'Inovasi rekayasa teknologi untuk menjawab tantangan industri masa depan.',
                        'icon'  => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                        'grad'  => 'from-indigo-600 to-violet-600',
                        'glow'  => 'shadow-indigo-900/40',
                        'badge' => 'Teknik & Rekayasa',
                    ],
                    [
                        'nama'  => 'Ekonomi',
                        'desc'  => 'Menghasilkan pemimpin bisnis yang adaptif, kreatif, dan berdaya saing global.',
                        'icon'  => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
                        'grad'  => 'from-cyan-600 to-blue-600',
                        'glow'  => 'shadow-cyan-900/40',
                        'badge' => 'Bisnis & Manajemen',
                    ],
                    [
                        'nama'  => 'Ilmu Komputer',
                        'desc'  => 'Pusat keunggulan software engineering, AI, dan data science bertaraf internasional.',
                        'icon'  => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v3m0 0a2 2 0 01-2 2H9m4-2V5',
                        'grad'  => 'from-violet-600 to-pink-600',
                        'glow'  => 'shadow-violet-900/40',
                        'badge' => 'Teknologi Informasi',
                    ],
                ];
            @endphp

            @foreach($fakPreview as $f)
            <div class="group relative bg-gray-900/60 backdrop-blur border border-gray-800 rounded-2xl p-7 hover:border-indigo-500/40 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 overflow-hidden">

                {{-- Glow on hover --}}
                <div class="absolute inset-0 bg-gradient-to-br {{ $f['grad'] }} opacity-0 group-hover:opacity-5 transition-opacity duration-300 rounded-2xl"></div>

                {{-- Icon --}}
                <div class="w-13 h-13 w-12 h-12 rounded-xl bg-gradient-to-br {{ $f['grad'] }} flex items-center justify-center mb-5 shadow-lg {{ $f['glow'] }} group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $f['icon'] }}"/>
                    </svg>
                </div>

                {{-- Badge --}}
                <span class="inline-block text-xs font-semibold text-gray-500 bg-gray-800 px-2.5 py-1 rounded-full mb-3">
                    {{ $f['badge'] }}
                </span>

                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-indigo-300 transition-colors">
                    Fakultas {{ $f['nama'] }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    {{ $f['desc'] }}
                </p>

                {{-- Arrow --}}
                <div class="mt-5 flex items-center gap-1 text-indigo-400 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span>Pelajari lebih lanjut</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Link ke halaman lengkap --}}
        <div class="text-center mt-12">
            <a href="{{ route('fakultas.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-gray-700 hover:border-indigo-500/50 text-gray-400 hover:text-white text-sm font-medium bg-gray-900/50 hover:bg-gray-800/50 transition-all duration-200 group">
                Lihat Semua Fakultas
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

    </div>
</section>