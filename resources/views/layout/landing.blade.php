<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'AdzkiaSI') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-neutral-050">

    <x-landing.navbar />

    <main>
        {{ $slot }}
    </main>

    <x-landing.footer />

    {{-- ponytail: Simplified FAB using Tailwind classes --}}
    <div class="fixed bottom-8 right-8 z-50 group">
        <a href="{{ route('ai.index') }}" title="Tanya AI Kampus"
           class="flex items-center justify-center w-14 h-14 rounded-full bg-brand-cyan-700 shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-200 relative">
            <div class="absolute inset-0 rounded-full bg-brand-cyan-500/50 animate-pulse"></div>
            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
            <div class="absolute top-0 right-0 w-4 h-4 rounded-full bg-status-success-bg border-2 border-white"></div>
            <span class="absolute right-full mr-4 px-3 py-1.5 rounded-md text-sm font-medium bg-neutral-900 text-white opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                Tanya AI Kampus
                <span class="absolute top-1/2 -right-1.5 transform -translate-y-1/2 w-3 h-3 bg-neutral-900 rotate-45"></span>
            </span>
        </a>
    </div>

</body>
</html>
