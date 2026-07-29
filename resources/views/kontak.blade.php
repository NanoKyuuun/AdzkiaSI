<x-landing>
    <section class="py-16 px-6 bg-white min-h-screen">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-14">
                <h1 class="text-4xl font-extrabold mb-4 text-neutral-900">Kontak <span class="text-brand-cyan-700">Kami</span></h1>
                <p class="text-neutral-500 max-w-xl mx-auto text-lg">
                    Ada pertanyaan? Kami siap membantu. Hubungi kami melalui salah satu cara di bawah ini.
                </p>
            </div>

            <div class="grid lg:grid-cols-5 gap-10">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-neutral-025 border border-neutral-200 rounded-lg p-6 space-y-4">
                        <h2 class="font-bold text-lg text-neutral-900">Informasi Kontak</h2>
                        @foreach([
                            ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Alamat', 'lines' => ['Jl. Kampus Merdeka No.1,<br>Kota Pendidikan, Indonesia']],
                            ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'title' => 'Telepon', 'lines' => ['+62 (0274) 123-4567', 'Senin – Jumat, 08:00–16:00']],
                            ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Email', 'lines' => ['info@adzkia.ac.id', 'akademik@adzkia.ac.id']]
                        ] as $item)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-brand-cyan-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-cyan-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-neutral-900">{{ $item['title'] }}</p>
                                @foreach($item['lines'] as $line)
                                    <p class="text-neutral-500 text-sm mt-0.5">{!! $line !!}</p>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="bg-neutral-025 border border-neutral-200 rounded-lg p-6">
                        <h2 class="font-bold text-lg mb-4 text-neutral-900">Kirim Pesan</h2>
                        @if(session('success'))
                        <div class="flex items-center gap-3 px-4 py-3 rounded bg-status-success-bg text-status-success-text text-sm font-medium mb-4">
                            {{ session('success') }}
                        </div>
                        @endif
                        <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="nama" class="input @error('nama') border-status-danger-border @enderror" value="{{ old('nama') }}" required>
                                    @error('nama')<p class="text-status-danger-text text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Email</label>
                                    <input type="email" name="email" class="input @error('email') border-status-danger-border @enderror" value="{{ old('email') }}" required>
                                    @error('email')<p class="text-status-danger-text text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-[11px] font-medium text-neutral-700 mb-1">Subjek</label>
                                <input type="text" name="subjek" class="input @error('subjek') border-status-danger-border @enderror" value="{{ old('subjek') }}" required>
                                @error('subjek')<p class="text-status-danger-text text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-[11px] font-medium text-neutral-700 mb-1">Pesan</label>
                                <textarea name="pesan" rows="4" class="input resize-none @error('pesan') border-status-danger-border @enderror" required>{{ old('pesan') }}</textarea>
                                @error('pesan')<p class="text-status-danger-text text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-full">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-landing>
