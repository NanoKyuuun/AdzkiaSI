<x-landing>

<section class="py-16 px-6 bg-base-100 min-h-screen">
    <div class="max-w-6xl mx-auto">

        {{-- Page Header --}}
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Institusi Kami
            </div>
            <h1 class="text-4xl font-extrabold mb-4">Fakultas <span class="text-primary">KampusKu</span></h1>
            <p class="text-base-content/60 max-w-xl mx-auto text-lg">
                Kami memiliki {{ $fakultas->count() }} fakultas unggulan yang siap membawa Anda ke jenjang karir terbaik.
            </p>
        </div>

        {{-- Faculty Cards --}}
        @if($fakultas->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($fakultas as $f)
            @php
                $icons = ['M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4','M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v3','M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'];
                $colors = ['from-violet-500 to-purple-600','from-blue-500 to-cyan-600','from-emerald-500 to-teal-600','from-orange-500 to-amber-600','from-rose-500 to-pink-600','from-indigo-500 to-blue-600'];
                $i = $loop->index % count($icons);
                $c = $loop->index % count($colors);
            @endphp
            <div class="card bg-base-200 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-base-300 group">
                <div class="card-body">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $colors[$c] }} flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $icons[$i] }}"/>
                        </svg>
                    </div>
                    <h3 class="card-title text-lg">{{ $f->name_fakultas }}</h3>
                    <p class="text-base-content/60 text-sm">Kode: <span class="font-mono font-semibold text-primary">{{ $f->kode_fakultas ?? '-' }}</span></p>
                    <div class="divider my-2"></div>
                    <div class="flex items-center justify-between text-sm text-base-content/60">
                        <span>{{ $f->programStudis->count() }} Program Studi</span>
                        <a href="{{ route('program-studi.index') }}?fakultas={{ $f->id }}" class="text-primary font-semibold hover:underline flex items-center gap-1">
                            Lihat Prodi
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="w-20 h-20 rounded-2xl bg-base-200 flex items-center justify-center mb-4">
                <svg class="w-10 h-10 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                </svg>
            </div>
            <p class="text-base-content/40 font-medium">Belum ada data fakultas.</p>
        </div>
        @endif

        {{-- CTA --}}
        <div class="mt-16 text-center">
            <a href="{{ route('ai.index') }}" class="btn btn-primary btn-lg gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
                Tanya AI tentang Fakultas
            </a>
        </div>
    </div>
</section>

</x-landing>
