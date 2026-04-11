<x-guest>

    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-primary mb-2">Register</h2>
        <p class="text-sm text-base-content/60">Buat akun untuk mulai mengelola data kampus.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="form-control w-full">
            <label class="label pt-0">
                <span class="label-text font-semibold">Nama Lengkap</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" 
                class="input input-bordered w-full @error('name') input-error @enderror" 
                placeholder="Masukkan nama" required>
            @error('name')
                <span class="text-error text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text font-semibold">Email</span>
            </label>
            <input type="email" name="email" value="{{ old('email') }}" 
                class="input input-bordered w-full @error('email') input-error @enderror" 
                placeholder="email@contoh.com" required>
            @error('email')
                <span class="text-error text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text font-semibold">Password</span>
            </label>
            <input type="password" name="password" 
                class="input input-bordered w-full @error('password') input-error @enderror" 
                placeholder="Min. 8 karakter" required>
            @error('password')
                <span class="text-error text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="pt-4">
            <button class="btn btn-primary btn-block text-lg">
                Daftar
            </button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-base-200 text-center">
        <p class="text-sm">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="link link-primary font-bold">Login</a>
        </p>
    </div>

</x-guest>