<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — {{ config('app.name', 'AdzkiaSI') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: { 900: '#213F66', 500: '#18B7D8', 600: '#178FD1', 100: '#EAF5FB' },
                        text: { 900: '#24364B', 600: '#66788A', 400: '#98A7B5' },
                        border: '#E3E9EF', page: '#EEF3F7',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .input-field { width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #E3E9EF; border-radius: 3px; font-size: 14px; transition: border-color 0.15s, box-shadow 0.15s; }
        .input-field:focus { outline: none; border-color: #178FD1; box-shadow: 0 0 0 3px rgba(23,143,209,0.1); }
    </style>
</head>
<body class="bg-page min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-sm">
        {{ $slot }}
        <p class="text-center mt-8 text-xs text-text-400">&copy; {{ date('Y') }} {{ config('app.name', 'AdzkiaSI') }}.</p>
    </div>
</body>
</html>
