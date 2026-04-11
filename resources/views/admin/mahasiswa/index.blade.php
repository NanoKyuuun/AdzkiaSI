<x-app>
    <x-slot:title>Manajemen Mahasiswa</x-slot:title>
    <x-slot:header>Mahasiswa</x-slot:header>

    <div class="space-y-6">
        <!-- Alert Section -->
        @if(session('success'))
            <div class="alert alert-success shadow-lg border-2 border-success/20 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error shadow-lg border-2 border-error/20 rounded-2xl text-white">
                <ul class="list-disc list-inside font-bold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 bg-base-100 p-8 rounded-3xl border-2 border-base-300 shadow-sm">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-1">Daftar Mahasiswa</h1>
                <p class="text-slate-500 font-medium">Kelola data mahasiswa aktif, alumni, dan registrasi akun.</p>
            </div>
            <button onclick="modal_add_mahasiswa.showModal()" class="btn btn-primary btn-lg px-8 shadow-lg shadow-primary/20 font-bold group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-125 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Mahasiswa
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-base-100 rounded-3xl border-2 border-base-300 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-lg w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b-2 border-base-200">
                            <th class="py-6 text-slate-900 font-black uppercase tracking-wider text-xs">No</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">NIM</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Nama Lengkap</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Prodi</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Angkatan</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Status</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($mahasiswas as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-all duration-200">
                            <td class="font-black text-slate-400 text-sm">{{ $index + 1 }}</td>
                            <td>
                                <span class="badge badge-lg bg-slate-900 text-white font-mono font-bold px-4 py-3 border-none rounded-lg">
                                    {{ $item->nim }}
                                </span>
                            </td>
                            <td>
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-900 text-lg tracking-tight">{{ $item->nama }}</span>
                                    <span class="text-xs text-slate-500 font-medium italic">{{ $item->user->email }}</span>
                                </div>
                            </td>
                            <td class="text-slate-600 font-medium italic text-sm">{{ $item->programStudi->nama_prodi }}</td>
                            <td class="text-center font-bold text-slate-700">{{ $item->angkatan }}</td>
                            <td class="text-center">
                                @if($item->status == 'aktif')
                                    <span class="badge badge-lg bg-emerald-100 text-emerald-700 border-2 border-emerald-200 font-black uppercase text-[10px] px-4">
                                        {{ $item->status }}
                                    </span>
                                @else
                                    <span class="badge badge-lg bg-slate-100 text-slate-600 border-2 border-slate-200 font-black uppercase text-[10px] px-4">
                                        {{ $item->status }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center gap-3">
                                    <button onclick="editMahasiswa({{ $item->id }}, '{{ $item->nim }}', '{{ $item->nama }}', {{ $item->prodi_id }}, '{{ $item->angkatan }}', '{{ $item->status }}')" 
                                        class="btn btn-square btn-md btn-ghost border-2 border-transparent hover:border-blue-200 hover:bg-blue-50 text-blue-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.mahasiswa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-square btn-md btn-ghost border-2 border-transparent hover:border-red-200 hover:bg-red-50 text-red-600 transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-20">
                                <div class="flex flex-col items-center">
                                    <div class="bg-slate-100 p-6 rounded-full mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-bold italic">Belum ada data mahasiswa yang terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modals dengan High Contrast -->
    <dialog id="modal_add_mahasiswa" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl w-11/12 max-w-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Tambah Mahasiswa Baru</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form action="{{ route('admin.mahasiswa.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Nomor Induk Mahasiswa (NIM)</span>
                        </label>
                        <input type="text" name="nim" placeholder="Masukkan NIM mahasiswa" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Program Studi</span>
                        </label>
                        <select name="prodi_id" class="select select-bordered select-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required>
                            <option value="" disabled selected>Pilih Prodi</option>
                            @foreach($prodis as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Nama Lengkap</span>
                    </label>
                    <input type="text" name="nama" placeholder="Masukkan nama mahasiswa sesuai KTP" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Email (Untuk Login)</span>
                    </label>
                    <input type="email" name="email" placeholder="mahasiswa@universitas.ac.id" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Angkatan</span>
                        </label>
                        <input type="number" name="angkatan" placeholder="Contoh: 2023" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Status Awal</span>
                        </label>
                        <select name="status" class="select select-bordered select-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required>
                            <option value="aktif" selected>Aktif</option>
                            <option value="non-aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Password</span>
                        </label>
                        <input type="password" name="password" placeholder="Min. 8 karakter" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                </div>
                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Simpan Data Mahasiswa</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="modal_edit_mahasiswa" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl w-11/12 max-w-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Edit Data Mahasiswa</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form id="form_edit_mahasiswa" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">NIM</span>
                        </label>
                        <input type="text" id="edit_nim" name="nim" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Program Studi</span>
                        </label>
                        <select id="edit_prodi_id" name="prodi_id" class="select select-bordered select-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required>
                            @foreach($prodis as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Nama Lengkap</span>
                    </label>
                    <input type="text" id="edit_nama" name="nama" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Angkatan</span>
                        </label>
                        <input type="number" id="edit_angkatan" name="angkatan" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Status Akademik</span>
                        </label>
                        <select id="edit_status" name="status" class="select select-bordered select-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required>
                            <option value="aktif">Aktif</option>
                            <option value="non-aktif">Non-Aktif</option>
                            <option value="lulus">Lulus</option>
                            <option value="drop-out">Drop-Out</option>
                        </select>
                    </div>
                </div>
                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Perbarui Informasi</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function editMahasiswa(id, nim, nama, prodi_id, angkatan, status) {
            const form = document.getElementById('form_edit_mahasiswa');
            form.action = `/admin/mahasiswa/${id}`;
            document.getElementById('edit_nim').value = nim;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_prodi_id').value = prodi_id;
            document.getElementById('edit_angkatan').value = angkatan;
            document.getElementById('edit_status').value = status;
            modal_edit_mahasiswa.showModal();
        }
    </script>
</x-app>
