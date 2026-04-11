<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'KampusKu') }}</title>

    <!-- DaisyUI & Tailwind CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-200 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <!-- Area Konten Utama (Form Login/Register) -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body p-10">
                {{ $slot }}
            </div>
        </div>
        
        <!-- Footer Opsional di bawah Card -->
        <p class="text-center mt-8 text-sm text-base-content/40 italic">
            &copy; {{ date('Y') }} {{ config('app.name', 'KampusKu') }}. All rights reserved.
        </p>
    </div>

</body>
</html>
