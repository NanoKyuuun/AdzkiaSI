{{-- ponytail: Simplified "Fakultas" section, light theme --}}
<section class="py-24 px-6 bg-neutral-050 border-y border-neutral-200">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-14">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-neutral-900 mb-4">
                Fakultas <span class="text-brand-cyan-700">Unggulan</span>
            </h2>
            <p class="text-neutral-500 max-w-lg mx-auto">
                Temukan jalur pendidikan yang sesuai dengan passion dan tujuan karir Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $fakPreview = [
                    ['nama' => 'Teknik', 'desc' => 'Inovasi rekayasa teknologi untuk menjawab tantangan industri masa depan.', 'badge' => 'Teknik & Rekayasa'],
                    ['nama' => 'Ekonomi', 'desc' => 'Menghasilkan pemimpin bisnis yang adaptif, kreatif, dan berdaya saing global.', 'badge' => 'Bisnis & Manajemen'],
                    ['nama' => 'Ilmu Komputer', 'desc' => 'Pusat keunggulan software engineering, AI, dan data science.', 'badge' => 'Teknologi Informasi'],
                ];
            @endphp

            @foreach($fakPreview as $f)
            <div class="bg-neutral-000 border border-neutral-200 rounded-lg p-7 hover:shadow-soft transition-all duration-300">
                <span class="inline-block text-xs font-medium text-neutral-500 bg-neutral-050 px-2.5 py-1 rounded mb-3">
                    {{ $f['badge'] }}
                </span>
                <h3 class="text-xl font-bold text-neutral-900 mb-2">Fakultas {{ $f['nama'] }}</h3>
                <p class="text-neutral-500 text-sm leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('fakultas.index') }}" class="btn btn-secondary">
                Lihat Semua Fakultas
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
