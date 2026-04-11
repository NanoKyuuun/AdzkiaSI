{{-- ============================================================
     TENTANG SECTION — Elegan + Responsif
     ============================================================ --}}
<section class="py-24 px-6 bg-gray-950 relative overflow-hidden">

    {{-- Background accent --}}
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-indigo-500/30 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-indigo-500/30 to-transparent"></div>

    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Text --}}
            <div>
                <div class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-6">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Tentang Kami
                </div>

                <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-6 leading-tight">
                    Mendidik Generasi <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Unggul & Berkarakter</span>
                </h2>

                <p class="text-gray-400 text-lg leading-relaxed mb-6">
                    KampusKu berdiri sejak 1990 dengan komitmen penuh menghadirkan pendidikan
                    tinggi yang relevan, inovatif, dan berdampak nyata bagi masyarakat luas.
                </p>
                <p class="text-gray-500 leading-relaxed mb-10">
                    Dengan lebih dari 3 dekade pengalaman, kami terus berkembang mengikuti
                    kebutuhan industri global tanpa meninggalkan nilai-nilai kearifan lokal.
                </p>

                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2 text-sm text-gray-300">
                        <div class="w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center">
                            <svg class="w-3 h-3 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        Akreditasi A Nasional
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-300">
                        <div class="w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center">
                            <svg class="w-3 h-3 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        Kurikulum Berbasis Industri
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-300">
                        <div class="w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center">
                            <svg class="w-3 h-3 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        Kemitraan 100+ Perusahaan
                    </div>
                </div>
            </div>

            {{-- Right: Feature Cards --}}
            <div class="grid grid-cols-2 gap-4">
                @php
                    $features = [
                        ['icon'  => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                          'title' => 'AI-Powered',
                          'desc'  => 'Asisten akademik berbasis AI untuk mahasiswa',
                          'color' => 'indigo'],
                        ['icon'  => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                          'title' => 'Dosen Ahli',
                          'desc'  => 'Tenaga pengajar berpengalaman & bersertifikat',
                          'color' => 'violet'],
                        ['icon'  => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z',
                          'title' => 'Riset Aktif',
                          'desc'  => 'Pusat riset terkemuka & publikasi internasional',
                          'color' => 'cyan'],
                        ['icon'  => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9',
                          'title' => 'Jaringan Global',
                          'desc'  => 'Kemitraan dengan universitas luar negeri',
                          'color' => 'emerald'],
                    ];
                @endphp
                @foreach($features as $f)
                @php
                    $colorMap = [
                        'indigo'  => ['bg' => 'bg-indigo-500/10', 'icon' => 'text-indigo-400', 'border' => 'border-indigo-500/20'],
                        'violet'  => ['bg' => 'bg-violet-500/10', 'icon' => 'text-violet-400', 'border' => 'border-violet-500/20'],
                        'cyan'    => ['bg' => 'bg-cyan-500/10',   'icon' => 'text-cyan-400',   'border' => 'border-cyan-500/20'],
                        'emerald' => ['bg' => 'bg-emerald-500/10','icon' => 'text-emerald-400','border' => 'border-emerald-500/20'],
                    ];
                    $c = $colorMap[$f['color']];
                @endphp
                <div class="bg-gray-900/50 backdrop-blur border {{ $c['border'] }} rounded-2xl p-5 hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl {{ $c['bg'] }} flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 {{ $c['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $f['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-white text-sm mb-1">{{ $f['title'] }}</h3>
                    <p class="text-gray-500 text-xs leading-snug">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>