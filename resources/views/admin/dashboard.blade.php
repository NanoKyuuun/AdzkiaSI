<x-app>
    <x-slot:title>Ringkasan Dashboard</x-slot:title>
    <x-slot:header>Statistik Utama</x-slot:header>

    <div class="space-y-8">
        <!-- Hero Section: Kontras Tinggi -->
        <div class="relative overflow-hidden bg-primary text-primary-content rounded-3xl p-8 lg:p-12 shadow-xl border-4 border-primary-content/10">
            <div class="relative z-10 max-w-3xl">
                <span class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-xs font-black uppercase tracking-[0.2em] mb-6 border border-white/30">
                    Laporan Sistem Aktif
                </span>
                <h1 class="text-4xl lg:text-6xl font-black mb-4 tracking-tighter leading-none">
                    Halo, {{ explode(' ', Auth::user()->name)[0] }}!
                </h1>
                <p class="text-lg lg:text-xl font-medium opacity-90 leading-relaxed max-w-xl">
                    Sistem dalam kondisi <span class="text-white underline decoration-wavy decoration-2 underline-offset-4 font-black">Optimal</span>. Pantau seluruh data akademik kampus Anda dalam satu tampilan cerdas.
                </p>
            </div>
            
            <!-- Dekorasi Ikon Besar -->
            <div class="absolute top-1/2 -right-12 -translate-y-1/2 opacity-10 hidden lg:block rotate-12 scale-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-64 w-64" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
        </div>
        
        <!-- Stats Grid: Background Putih Solid, Border Gelap -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card Mahasiswa -->
            <div class="bg-base-100 border-2 border-base-300 rounded-2xl p-6 shadow-sm hover:border-primary transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-primary/10 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="badge badge-primary badge-outline font-bold">Total</span>
                </div>
                <div class="text-slate-500 text-xs font-black uppercase tracking-widest mb-1">Mahasiswa</div>
                <div class="text-4xl font-black text-slate-900 tracking-tight">{{ $stats['total_mahasiswa'] }}</div>
                <div class="mt-4 pt-4 border-t border-base-200 text-xs text-slate-400 font-medium italic">Data mahasiswa terverifikasi</div>
            </div>

            <!-- Card Dosen -->
            <div class="bg-base-100 border-2 border-base-300 rounded-2xl p-6 shadow-sm hover:border-secondary transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-secondary/10 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="badge badge-secondary badge-outline font-bold">Aktif</span>
                </div>
                <div class="text-slate-500 text-xs font-black uppercase tracking-widest mb-1">Dosen Pengajar</div>
                <div class="text-4xl font-black text-slate-900 tracking-tight">{{ $stats['total_dosen'] }}</div>
                <div class="mt-4 pt-4 border-t border-base-200 text-xs text-slate-400 font-medium italic">Tenaga ahli pengajar</div>
            </div>

            <!-- Card Fakultas/Prodi -->
            <div class="bg-base-100 border-2 border-base-300 rounded-2xl p-6 shadow-sm hover:border-accent transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-accent/10 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="badge badge-accent badge-outline font-bold">Unit</span>
                </div>
                <div class="text-slate-500 text-xs font-black uppercase tracking-widest mb-1">Fakultas / Prodi</div>
                <div class="text-4xl font-black text-slate-900 tracking-tight">{{ $stats['total_fakultas'] }} <span class="text-xl text-slate-400">/ {{ $stats['total_prodi'] }}</span></div>
                <div class="mt-4 pt-4 border-t border-base-200 text-xs text-slate-400 font-medium italic">Unit organisasi kampus</div>
            </div>

            <!-- Card KRS Pending -->
            <div class="bg-base-100 border-2 border-base-300 rounded-2xl p-6 shadow-sm hover:border-warning transition-all duration-300 ring-4 ring-warning/5 animate-pulse">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-warning/20 p-3 rounded-xl border border-warning/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-warning-content" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="badge badge-warning font-black shadow-sm">Urgent</span>
                </div>
                <div class="text-warning-content/70 text-xs font-black uppercase tracking-widest mb-1">KRS Pending</div>
                <div class="text-4xl font-black text-warning tracking-tight">{{ $stats['krs_pending'] }}</div>
                <div class="mt-4 pt-4 border-t border-warning/20 text-xs text-warning-content font-bold italic underline">Butuh Validasi Segera</div>
            </div>
        </div>

        <!-- Quick Info Banner -->
        <div class="alert bg-slate-900 text-white rounded-2xl shadow-lg p-6 border-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="flex flex-col ml-2">
                <h3 class="font-black text-lg">Catatan Maintenance:</h3>
                <p class="text-slate-400 font-medium">Dashboard ini menggunakan tema korporat dengan kontras tinggi untuk memastikan semua informasi terbaca dengan jelas oleh admin sistem.</p>
            </div>
        </div>
    </div>
</x-app>
