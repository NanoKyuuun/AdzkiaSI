<x-landing>

<section class="py-16 px-6 bg-base-100 min-h-screen">
    <div class="max-w-6xl mx-auto">

        {{-- Page Header --}}
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-secondary/10 text-secondary px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Akademik
            </div>
            <h1 class="text-4xl font-extrabold mb-4">Program <span class="text-secondary">Studi</span></h1>
            <p class="text-base-content/60 max-w-xl mx-auto text-lg">
                Temukan program studi yang sesuai dengan passion dan impian karir Anda.
            </p>
        </div>

        {{-- Stats Bar --}}
        <div class="stats shadow w-full mb-10 bg-base-200">
            <div class="stat">
                <div class="stat-figure text-primary">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                    </svg>
                </div>
                <div class="stat-title">Total Fakultas</div>
                <div class="stat-value text-primary">{{ $fakultas->count() }}</div>
            </div>
            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="stat-title">Program Studi</div>
                <div class="stat-value text-secondary">{{ $prodis->count() }}</div>
            </div>
            <div class="stat">
                <div class="stat-figure text-accent">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="stat-title">Total Dosen</div>
                <div class="stat-value text-accent">{{ $totalDosen }}</div>
            </div>
        </div>

        {{-- Group per Fakultas --}}
        @forelse($fakultas as $f)
        @if($f->programStudis->count() > 0)
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold">{{ $f->name_fakultas }}</h2>
                    <p class="text-sm text-base-content/50">{{ $f->programStudis->count() }} Program Studi</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($f->programStudis as $p)
                @php
                    $badgeColor = match(strtoupper($p->jenjang ?? '')) {
                        'S1' => 'badge-primary',
                        'S2' => 'badge-secondary',
                        'D3' => 'badge-accent',
                        'D4' => 'badge-warning',
                        default => 'badge-ghost'
                    };
                @endphp
                <div class="card bg-base-200 border border-base-300 hover:border-primary/40 hover:shadow-lg transition-all duration-200 group">
                    <div class="card-body py-5 px-5">
                        <div class="flex items-start justify-between gap-2">
                            <h3 class="font-bold text-sm leading-snug group-hover:text-primary transition-colors">{{ $p->nama_prodi }}</h3>
                            <span class="badge {{ $badgeColor }} badge-sm flex-shrink-0">{{ $p->jenjang ?? 'N/A' }}</span>
                        </div>
                        @if($p->kode_prodi)
                        <p class="text-xs text-base-content/50 mt-1 font-mono">Kode: {{ $p->kode_prodi }}</p>
                        @endif
                        <div class="flex items-center gap-1 mt-2 text-xs text-base-content/50">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $p->dosens->count() }} Dosen
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @empty
        <div class="text-center py-20 text-base-content/40">
            <p>Belum ada data program studi.</p>
        </div>
        @endforelse

        {{-- CTA --}}
        <div class="mt-10 text-center">
            <a href="{{ route('ai.index') }}" class="btn btn-primary gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
                Tanya AI tentang Program Studi
            </a>
        </div>
    </div>
</section>

</x-landing>
