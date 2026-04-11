<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }} - {{ config('app.name', 'KampusKu') }}</title>
    
    <!-- Tailwind & DaisyUI CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">
    
    <!-- Google Fonts: Inter untuk tampilan UI yang modern & tajam -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        /* Memastikan scrollbar tetap terlihat bersih */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-base-200 h-screen overflow-hidden text-base-content">
    <div class="drawer lg:drawer-open">
        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
        
        <!-- Main Content Area -->
        <div class="drawer-content flex flex-col overflow-hidden">
            
            <!-- Navbar: Kontras Tinggi -->
            <header class="navbar bg-base-100 border-b border-base-300 px-4 lg:px-8 h-20 min-h-[5rem] z-20 shadow-sm">
                <div class="flex-none lg:hidden">
                    <label for="sidebar-drawer" aria-label="open sidebar" class="btn btn-ghost btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                
                <div class="flex-1 px-2">
                    <div class="flex flex-col">
                        <h2 class="text-xl lg:text-2xl font-extrabold tracking-tight text-slate-900">{{ $header ?? 'Dashboard' }}</h2>
                        <span class="text-xs font-medium text-slate-500 hidden sm:block">Sistem Informasi Manajemen Kampus</span>
                    </div>
                </div>

                <div class="flex-none gap-3">
                    <!-- User Info (Desktop) -->
                    <div class="hidden md:flex flex-col items-end mr-3 border-r border-base-300 pr-5">
                        <span class="font-bold text-sm text-slate-900">{{ Auth::user()->name }}</span>
                        <div class="badge badge-primary badge-outline badge-sm mt-1 font-bold tracking-wider text-[10px] uppercase">
                            {{ Auth::user()->role }}
                        </div>
                    </div>

                    <!-- User Dropdown -->
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar ring ring-primary ring-offset-base-100 ring-offset-2">
                            <div class="w-10 rounded-full">
                                <img alt="User Avatar" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=ffffff&background=2563eb&bold=true" />
                            </div>
                        </div>
                        <ul tabindex="0" class="mt-4 z-[30] p-2 shadow-2xl menu menu-md dropdown-content bg-base-100 rounded-xl w-64 border border-base-300">
                            <li class="menu-title px-4 py-3 border-b border-base-200 mb-2">
                                <span class="text-slate-900 font-extrabold block">{{ Auth::user()->name }}</span>
                                <span class="text-xs font-medium text-slate-500 uppercase">{{ Auth::user()->role }} Account</span>
                            </li>
                            <li><a class="py-3 font-semibold text-slate-700 hover:text-primary"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg> Pengaturan Profil</a></li>
                            <div class="divider my-1 opacity-30"></div>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left text-error flex items-center gap-2 font-bold py-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                        Keluar dari Sistem
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-10 bg-base-200/50">
                <div class="w-full max-w-[1600px] mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Sidebar Area -->
        <div class="drawer-side z-40 border-r border-base-300">
            <label for="sidebar-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <!-- Konten Sidebar diserahkan ke komponen x-sidebar -->
            <div class="bg-base-100 min-h-full w-80">
                <x-sidebar.sidebar />
            </div>
        </div>
    </div>
</body>
</html>
