<x-landing>
    <section class="py-16 px-6 bg-white min-h-screen">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-14">
                <h1 class="text-4xl font-extrabold mb-4 text-neutral-900">Program <span class="text-brand-cyan-700">Studi</span></h1>
                <p class="text-neutral-500 max-w-xl mx-auto text-lg">
                    Temukan program studi yang sesuai dengan passion dan impian karir Anda.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-10">
                <div class="bg-neutral-025 border border-neutral-200 rounded-lg p-5 text-center">
                    <p class="text-2xl font-bold text-brand-cyan-700">{{ $fakultas->count() }}</p>
                    <p class="text-xs text-neutral-500 uppercase font-medium mt-1">Fakultas</p>
                </div>
                <div class="bg-neutral-025 border border-neutral-200 rounded-lg p-5 text-center">
                    <p class="text-2xl font-bold text-brand-cyan-700">{{ $prodis->count() }}</p>
                    <p class="text-xs text-neutral-500 uppercase font-medium mt-1">Program Studi</p>
                </div>
                <div class="bg-neutral-025 border border-neutral-200 rounded-lg p-5 text-center">
                    <p class="text-2xl font-bold text-brand-cyan-700">{{ $totalDosen }}</p>
                    <p class="text-xs text-neutral-500 uppercase font-medium mt-1">Dosen</p>
                </div>
            </div>

            @forelse($fakultas as $f)
            @if($f->programStudis->count() > 0)
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-5">
                    <div>
                        <h2 class="text-xl font-bold text-neutral-900">{{ $f->name_fakultas }}</h2>
                        <p class="text-sm text-neutral-500">{{ $f->programStudis->count() }} Program Studi</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($f->programStudis as $p)
                    <div class="bg-white border border-neutral-200 rounded-lg p-5 hover:shadow-soft transition-all duration-200">
                        <div class="flex items-start justify-between gap-2">
                            <h3 class="font-bold text-sm leading-snug text-neutral-900">{{ $p->nama_prodi }}</h3>
                            <span class="badge bg-brand-cyan-100 text-brand-cyan-700 flex-shrink-0">{{ $p->jenjang ?? 'N/A' }}</span>
                        </div>
                        @if($p->kode_prodi)
                        <p class="text-xs text-neutral-500 mt-1 font-mono">Kode: {{ $p->kode_prodi }}</p>
                        @endif
                        <div class="flex items-center gap-1 mt-2 text-xs text-neutral-500">
                            {{ $p->dosens->count() }} Dosen
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @empty
            <div class="text-center py-20 text-neutral-500">
                <p>Belum ada data program studi.</p>
            </div>
            @endforelse

            <div class="mt-10 text-center">
                <a href="{{ route('ai.index') }}" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    Tanya AI tentang Program Studi
                </a>
            </div>
        </div>
    </section>
</x-landing>
