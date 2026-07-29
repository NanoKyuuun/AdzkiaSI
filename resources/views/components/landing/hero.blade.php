{{-- ponytail: Simplified hero, light theme --}}
<section class="relative bg-neutral-025 border-b border-neutral-200">
    <div class="max-w-7xl mx-auto px-6 py-24 lg:py-32 flex flex-col lg:flex-row items-center gap-16">
        <div class="flex-1 text-center lg:text-left">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-neutral-900 leading-tight mb-6">
                Eksplorasi Informasi <br class="hidden sm:block">
                <span class="text-brand-cyan-700">Kampus Cerdas</span>
            </h1>

            <p class="text-neutral-500 text-lg leading-relaxed mb-10 max-w-xl mx-auto lg:mx-0">
                Selamat datang di portal informasi resmi AdzkiaSI. Temukan data fakultas, program studi,
                dan profil dosen dengan bantuan asisten virtual berbasis kecerdasan buatan.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="{{ route('ai.index') }}" class="btn btn-primary">
                    Tanya FuzanAI
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                <a href="{{ route('fakultas.index') }}" class="btn btn-secondary">
                    Daftar Fakultas
                </a>
            </div>
        </div>

        <div class="flex-1 w-full max-w-md lg:max-max-lg">
            <div class="relative">
                <div class="relative bg-white border border-neutral-200 rounded-lg p-6 shadow-soft">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-3 h-3 rounded-full bg-status-danger-bg"></span>
                        <span class="w-3 h-3 rounded-full bg-status-warning-bg"></span>
                        <span class="w-3 h-3 rounded-full bg-status-success-bg"></span>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center gap-4 bg-neutral-025 border border-neutral-200 rounded-md p-3">
                            <span class="text-xl">🏛️</span>
                            <div>
                                <p class="text-sm font-medium text-neutral-900">Profil Institusi</p>
                                <p class="text-xs text-neutral-500">Data Fakultas & Prodi Terpadu</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 bg-neutral-025 border border-neutral-200 rounded-md p-3">
                            <span class="text-xl">🤖</span>
                            <div>
                                <p class="text-sm font-medium text-neutral-900">FuzanAI Aktif</p>
                                <p class="text-xs text-neutral-500">Siap menjawab info kampus</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
