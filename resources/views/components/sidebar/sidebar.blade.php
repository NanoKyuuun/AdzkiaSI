<div class="w-72 bg-white border-r border-gray-200 h-full flex flex-col shadow-sm">
    <div class="p-6 h-16 min-h-[4rem] border-b border-gray-100 flex items-center gap-3">
        <div class="bg-primary p-1.5 rounded-lg shadow-lg shadow-primary/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
        <h2 class="text-xl font-black text-gray-900 tracking-tight">
            Kampus<span class="text-primary">Ku</span>
        </h2>
    </div>
    
    <nav class="flex-1 overflow-y-auto p-4 space-y-1.5">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] px-4 py-3">Menu Utama</p>
        
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ Route::currentRouteName() == 'admin.dashboard' ? 'text-white' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-semibold">Dashboard</span>
        </a>

        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] px-4 pt-4 pb-2">Akademik</p>

        <a href="{{ route('admin.fakultas.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'admin.fakultas') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ str_starts_with(Route::currentRouteName(), 'admin.fakultas') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <span class="font-medium">Fakultas</span>
        </a>

        <a href="{{ route('admin.program-studi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'admin.program-studi') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ str_starts_with(Route::currentRouteName(), 'admin.program-studi') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            </svg>
            <span class="font-medium">Program Studi</span>
        </a>

        <a href="{{ route('admin.mata-kuliah.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'admin.mata-kuliah') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ str_starts_with(Route::currentRouteName(), 'admin.mata-kuliah') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span class="font-medium">Mata Kuliah</span>
        </a>

        <a href="{{ route('admin.kelas.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'admin.kelas') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ str_starts_with(Route::currentRouteName(), 'admin.kelas') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="font-medium">Kelas & Jadwal</span>
        </a>

        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] px-4 pt-6 pb-2">User Management</p>

        <a href="{{ route('admin.dosen.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'admin.dosen') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ str_starts_with(Route::currentRouteName(), 'admin.dosen') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="font-medium">Dosen</span>
        </a>

        <a href="{{ route('admin.mahasiswa.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'admin.mahasiswa') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ str_starts_with(Route::currentRouteName(), 'admin.mahasiswa') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="font-medium">Mahasiswa</span>
        </a>

        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] px-4 pt-6 pb-2">Layanan</p>

        <a href="{{ route('admin.krs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'admin.krs') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ str_starts_with(Route::currentRouteName(), 'admin.krs') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="font-medium">Pengisian KRS</span>
        </a>

        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] px-4 pt-8 pb-3">Sistem</p>

        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0" />
            </svg>
            <span class="font-medium">Settings</span>
        </a>
    </nav>
    
    <div class="p-6 border-t border-gray-100">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 w-full rounded-xl transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 group-hover:text-red-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="font-semibold">Sign Out</span>
            </button>
        </form>
    </div>
</div>
