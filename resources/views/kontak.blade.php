<x-landing>

<section class="py-16 px-6 bg-base-100 min-h-screen">
    <div class="max-w-5xl mx-auto">

        {{-- Page Header --}}
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-accent/10 text-accent px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Hubungi Kami
            </div>
            <h1 class="text-4xl font-extrabold mb-4">Kontak <span class="text-accent">Kami</span></h1>
            <p class="text-base-content/60 max-w-xl mx-auto text-lg">
                Ada pertanyaan? Kami siap membantu. Hubungi kami melalui salah satu cara di bawah ini.
            </p>
        </div>

        <div class="grid lg:grid-cols-5 gap-10">

            {{-- Info Kontak --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="card bg-base-200 shadow">
                    <div class="card-body gap-6">
                        <h2 class="font-bold text-lg">Informasi Kontak</h2>

                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-sm">Alamat</p>
                                <p class="text-base-content/60 text-sm mt-0.5">Jl. Kampus Merdeka No.1,<br>Kota Pendidikan, Indonesia</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-secondary/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-sm">Telepon</p>
                                <p class="text-base-content/60 text-sm mt-0.5">+62 (0274) 123-4567</p>
                                <p class="text-base-content/60 text-sm">Senin – Jumat, 08:00–16:00</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-sm">Email</p>
                                <p class="text-base-content/60 text-sm mt-0.5">info@kampusku.ac.id</p>
                                <p class="text-base-content/60 text-sm">akademik@kampusku.ac.id</p>
                            </div>
                        </div>

                        <div class="divider my-0"></div>

                        {{-- Sosial Media --}}
                        <div>
                            <p class="font-semibold text-sm mb-3">Ikuti Kami</p>
                            <div class="flex gap-3">
                                <a href="#" class="btn btn-sm btn-ghost btn-square border border-base-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <a href="#" class="btn btn-sm btn-ghost btn-square border border-base-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </a>
                                <a href="#" class="btn btn-sm btn-ghost btn-square border border-base-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.27 8.27 0 004.84 1.55V6.79a4.85 4.85 0 01-1.07-.1z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AI Shortcut --}}
                <a href="{{ route('ai.index') }}" class="card bg-gradient-to-br from-primary to-indigo-600 text-primary-content shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <div class="card-body flex-row items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Tanya FuzanAI</p>
                            <p class="text-sm opacity-80">Dapatkan jawaban instan tentang kampus</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Form Kontak --}}
            <div class="lg:col-span-3">
                <div class="card bg-base-200 shadow">
                    <div class="card-body">
                        <h2 class="font-bold text-lg mb-4">Kirim Pesan</h2>

                        @if(session('success'))
                        <div class="alert alert-success mb-4">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        @endif

                        <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="form-control">
                                    <label class="label"><span class="label-text font-medium">Nama Lengkap</span></label>
                                    <input type="text" name="nama" placeholder="Nama Anda"
                                        class="input input-bordered w-full @error('nama') input-error @enderror"
                                        value="{{ old('nama') }}" required>
                                    @error('nama')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text font-medium">Email</span></label>
                                    <input type="email" name="email" placeholder="email@contoh.com"
                                        class="input input-bordered w-full @error('email') input-error @enderror"
                                        value="{{ old('email') }}" required>
                                    @error('email')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-medium">Subjek</span></label>
                                <input type="text" name="subjek" placeholder="Perihal pesan Anda"
                                    class="input input-bordered w-full @error('subjek') input-error @enderror"
                                    value="{{ old('subjek') }}" required>
                                @error('subjek')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-medium">Pesan</span></label>
                                <textarea name="pesan" rows="5" placeholder="Tulis pesan Anda di sini..."
                                    class="textarea textarea-bordered w-full resize-none @error('pesan') textarea-error @enderror"
                                    required>{{ old('pesan') }}</textarea>
                                @error('pesan')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-full gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Map placeholder --}}
                <div class="mt-6 rounded-2xl overflow-hidden shadow border border-base-300 h-52 bg-base-200 flex items-center justify-center">
                    <div class="text-center text-base-content/40">
                        <svg class="w-10 h-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-sm font-medium">Google Maps Embed</p>
                        <p class="text-xs">Ganti dengan iframe Google Maps kampus Anda</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

</x-landing>
