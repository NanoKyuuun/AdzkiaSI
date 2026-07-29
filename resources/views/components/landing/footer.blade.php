{{-- ponytail: Simplified footer, light theme --}}
<footer class="bg-neutral-900 border-t border-neutral-200">
    <div class="max-w-7xl mx-auto px-6 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 rounded-md bg-brand-cyan-700 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold text-lg">AdzkiaSI</span>
                </div>
                <p class="text-neutral-500 text-sm leading-relaxed max-w-xs mb-5">
                    Institusi pendidikan tinggi unggulan yang berkomitmen mencetak generasi cerdas, inovatif, dan berkarakter.
                </p>
                <div class="flex gap-3">
                    @foreach(['Instagram', 'YouTube', 'TikTok'] as $name)
                    <a href="#" title="{{ $name }}" class="w-9 h-9 rounded-lg bg-neutral-800 hover:bg-brand-cyan-700 flex items-center justify-center transition-colors">
                        <span class="text-white text-xs font-bold">{{ $name[0] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Navigasi</h4>
                <ul class="space-y-2.5">
                    @foreach(['Beranda', 'Fakultas', 'Program Studi', 'Kontak'] as $link)
                    <li>
                        <a href="#" class="text-sm text-neutral-400 hover:text-white transition-colors">
                            {{ $link }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Hubungi Kami</h4>
                <ul class="space-y-3">
                    <li class="flex items-center gap-2.5 text-sm text-neutral-400">
                        <svg class="w-4 h-4 text-brand-cyan-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        info@adzkia.ac.id
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
