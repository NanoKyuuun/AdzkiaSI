{{-- ponytail: Simplified "Tentang" section, light theme --}}
<section class="py-24 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-neutral-900 mb-6 leading-tight">
                    Mendidik Generasi <br>
                    <span class="text-brand-cyan-700">Unggul & Berkarakter</span>
                </h2>

                <p class="text-neutral-500 text-lg leading-relaxed mb-10">
                    AdzkiaSI berdiri sejak 2026 dengan komitmen penuh menghadirkan pendidikan
                    tinggi yang relevan, inovatif, dan berdampak nyata bagi masyarakat luas.
                </p>

                <div class="grid grid-cols-2 gap-4">
                    @foreach (['Akreditasi A', 'Kurikulum Industri', '100+ Mitra'] as $item)
                    <div class="flex items-center gap-2 text-sm text-neutral-700">
                        <div class="w-5 h-5 rounded-full bg-status-success-bg flex items-center justify-center">
                            <svg class="w-3 h-3 text-status-success-text" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        {{ $item }}
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                @php
                    $features = [
                        ['icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'title' => 'AI-Powered', 'desc' => 'Asisten akademik berbasis AI untuk mahasiswa', 'color' => 'brand-cyan'],
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Dosen Ahli', 'desc' => 'Tenaga pengajar berpengalaman & bersertifikat', 'color' => 'status-success'],
                    ];
                @endphp
                @foreach($features as $f)
                <div class="bg-neutral-025 border border-neutral-200 rounded-lg p-5">
                    @if($f['color'] === 'brand-cyan')
                    <div class="w-10 h-10 rounded-lg bg-brand-cyan-100 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-brand-cyan-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}"/>
                        </svg>
                    </div>
                    @else
                    <div class="w-10 h-10 rounded-lg bg-status-success-bg flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-status-success-text" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}"/>
                        </svg>
                    </div>
                    @endif
                    <h3 class="font-bold text-neutral-900 text-sm mb-1">{{ $f['title'] }}</h3>
                    <p class="text-neutral-500 text-xs leading-snug">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
