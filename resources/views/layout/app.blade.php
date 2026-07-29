<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} — {{ config('app.name', 'AdzkiaSI') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

        <!-- Mobile overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black/50 z-20 lg:hidden" style="display: none;"></div>

        <!-- Sidebar -->
        <aside x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="w-64 bg-brand-navy-900 text-white flex-shrink-0 transition-all duration-200 ease-in-out fixed lg:static inset-y-0 left-0 z-30 lg:translate-x-0 flex flex-col">
            <x-sidebar.sidebar />
        </aside>

        <!-- Main area -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Topbar: h-14, white, border-b -->
            <header class="h-14 bg-white border-b border-neutral-200 flex items-center px-4 lg:px-6 gap-3 flex-shrink-0">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 -ml-2 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors lg:hidden">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-neutral-900">{{ config('app.name', 'AdzkiaSI') }}</span>
                </div>

                <div class="ml-auto flex items-center gap-4">
                    <span class="text-sm text-neutral-500 hidden sm:block">{{ Auth::user()->name }}</span>
                    <span class="hidden sm:inline-flex items-center px-2 py-0.5 rounded-[4px] text-[11px] font-medium bg-neutral-050 text-neutral-500">{{ Auth::user()->role }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 rounded text-neutral-500 hover:text-status-danger-text hover:bg-status-danger-bg transition-colors" title="Keluar">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content area: neutral.050 bg, 24px padding -->
            <main class="flex-1 overflow-y-auto bg-neutral-050">
                <div class="p-6">
                    @isset($header)
                        <div class="mb-1">
                            <h1 class="text-[24px] leading-[32px] font-semibold text-neutral-900">{{ $header }}</h1>
                        </div>
                    @endisset
                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>
</html>
