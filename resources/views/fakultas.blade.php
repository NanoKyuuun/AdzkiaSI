<x-landing>
    <section class="py-16 px-6 bg-white min-h-screen">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-14">
                <h1 class="text-4xl font-extrabold mb-4 text-neutral-900">Fakultas <span class="text-brand-cyan-700">AdzkiaSI</span></h1>
                <p class="text-neutral-500 max-w-xl mx-auto text-lg">
                    Kami memiliki {{ $fakultas->count() }} fakultas unggulan yang siap membawa Anda ke jenjang karir terbaik.
                </p>
            </div>

            @if($fakultas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($fakultas as $f)
                <div class="bg-white border border-neutral-200 rounded-lg p-7 hover:shadow-soft transition-all duration-300">
                    <h3 class="text-lg font-bold text-neutral-900 mb-2">{{ $f->name_fakultas }}</h3>
                    <p class="text-neutral-500 text-sm">Kode: <span class="font-mono font-medium text-brand-cyan-700">{{ $f->kode_fakultas ?? '-' }}</span></p>
                    <div class="border-t border-neutral-200 my-4"></div>
                    <div class="flex items-center justify-between text-sm text-neutral-500">
                        <span>{{ $f->programStudis->count() }} Program Studi</span>
                        <a href="{{ route('program-studi.index') }}?fakultas={{ $f->id }}" class="text-brand-cyan-700 font-medium hover:underline">
                            Lihat Prodi
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <p class="text-neutral-500 font-medium">Belum ada data fakultas.</p>
            </div>
            @endif

            <div class="mt-16 text-center">
                <a href="{{ route('ai.index') }}" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    Tanya AI tentang Fakultas
                </a>
            </div>
        </div>
    </section>
</x-landing>
