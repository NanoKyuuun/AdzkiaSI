<x-guest>
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded bg-primary-500 mb-4">
            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <h1 class="text-lg font-bold text-text-900">Masuk ke AdzkiaSI</h1>
        <p class="text-sm text-text-600 mt-1">Administrator dashboard</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-medium text-text-600 mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="input-field @error('email') border-danger @enderror"
                placeholder="admin@gmail.com" required autofocus>
            @error('email')
                <p class="text-xs text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs font-medium text-text-600 mb-1.5">Kata Sandi</label>
            <input type="password" name="password"
                class="input-field @error('password') border-danger @enderror"
                placeholder="password" required>
            @error('password')
                <p class="text-xs text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-primary-600 hover:bg-primary-500 text-white font-semibold py-2.5 px-4 rounded-md transition-colors text-sm">
            Masuk
        </button>
    </form>
</x-guest>
