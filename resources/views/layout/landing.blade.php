<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'KampusKu') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-950">

    <!-- Navbar -->
    <x-landing.navbar />

    <!-- Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-landing.footer />

    <!-- ===== FLOATING CHAT BUTTON ===== -->
    <style>
        .fab-chat {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 9999;
        }
        .fab-chat a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #4338ca);
            box-shadow: 0 8px 32px rgba(99,102,241,0.45);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            position: relative;
        }
        .fab-chat a:hover {
            transform: scale(1.12);
            box-shadow: 0 12px 40px rgba(99,102,241,0.65);
        }
        /* Tooltip */
        .fab-chat a::before {
            content: 'Tanya AI Kampus';
            position: absolute;
            right: calc(100% + 14px);
            top: 50%;
            transform: translateY(-50%);
            background: #1e1b4b;
            color: #c7d2fe;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid rgba(99,102,241,0.3);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }
        .fab-chat a::after {
            content: '';
            position: absolute;
            right: calc(100% + 6px);
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-left-color: #1e1b4b;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }
        .fab-chat a:hover::before,
        .fab-chat a:hover::after {
            opacity: 1;
        }
        /* Pulse ring */
        .fab-pulse {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(99,102,241,0.35);
            animation: fabPulse 2s ease-out infinite;
        }
        @keyframes fabPulse {
            0%   { transform: scale(1);   opacity: 0.7; }
            100% { transform: scale(1.9); opacity: 0; }
        }
        /* Notification dot */
        .fab-dot {
            position: absolute;
            top: 2px;
            right: 2px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #34d399;
            border: 2px solid white;
        }
    </style>

    <div class="fab-chat">
        <div class="fab-pulse"></div>
        <a href="{{ route('ai.index') }}" title="Tanya AI Kampus">
            <div class="fab-dot"></div>
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
        </a>
    </div>
    <!-- ===== END FLOATING CHAT BUTTON ===== -->

</body>
</html>