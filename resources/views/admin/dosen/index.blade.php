<x-app>
    <x-slot:title>Manajemen Dosen</x-slot:title>
    <x-slot:header>Dosen</x-slot:header>

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
                <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-1">Daftar Dosen</h1>
                <p class="text-slate-500 font-medium">Kelola data tenaga pengajar dan akun akses mereka.</p>
            </div>
            <button onclick="modal_add_dosen.showModal()" class="btn btn-primary btn-lg px-8 shadow-lg shadow-primary/20 font-bold group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-125 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Dosen
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-base-100 rounded-3xl border-2 border-base-300 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-lg w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b-2 border-base-200">
                            <th class="py-6 text-slate-900 font-black uppercase tracking-wider text-xs">No</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">NIDN</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Nama Dosen</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Email</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Program Studi</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Jabatan</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($dosens as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-all duration-200">
                            <td class="font-black text-slate-400 text-sm">{{ $index + 1 }}</td>
                            <td>
                                <span class="badge badge-lg bg-slate-900 text-white font-mono font-bold px-4 py-3 border-none rounded-lg">
                                    {{ $item->nidn }}
                                </span>
                            </td>
                            <td class="font-bold text-slate-900 text-lg">{{ $item->nama }}</td>
                            <td class="text-slate-600 font-medium">{{ $item->email }}</td>
                            <td class="text-slate-600 font-medium italic">{{ $item->programStudi->nama_prodi }}</td>
                            <td>
                                <span class="badge badge-lg badge-outline border-2 border-primary text-primary font-bold px-4 py-3 capitalize">
                                    {{ $item->jabatan }}
                                </span>
                            </td>
                            <td>
                                <div class="flex justify-center gap-3">
                                    <button onclick="editDosen({{ $item->id }}, '{{ $item->nidn }}', '{{ $item->nama }}', '{{ $item->email }}', {{ $item->prodi_id }}, '{{ $item->jabatan }}')" 
                                        class="btn btn-square btn-md btn-ghost border-2 border-transparent hover:border-blue-200 hover:bg-blue-50 text-blue-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.dosen.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dosen ini?')">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-bold italic">Belum ada data dosen yang terdaftar.</p>
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
    <dialog id="modal_add_dosen" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl w-11/12 max-w-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Tambah Dosen Baru</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form action="{{ route('admin.dosen.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">NIDN</span>
                        </label>
                        <input type="text" name="nidn" placeholder="Nomor Induk Dosen Nasional" 
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
                    <input type="text" name="nama" placeholder="Masukkan nama dosen lengkap beserta gelar" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Alamat Email</span>
                    </label>
                    <input type="email" name="email" placeholder="email@universitas.ac.id" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Jabatan Akademik</span>
                        </label>
                        <input type="text" name="jabatan" placeholder="Contoh: Lektor, Asisten Ahli" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Password Akun</span>
                        </label>
                        <input type="password" name="password" placeholder="Minimal 8 karakter" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                </div>
                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Simpan Data Dosen</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="modal_edit_dosen" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl w-11/12 max-w-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Edit Data Dosen</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form id="form_edit_dosen" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">NIDN</span>
                        </label>
                        <input type="text" id="edit_nidn" name="nidn" 
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
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Alamat Email</span>
                    </label>
                    <input type="email" id="edit_email" name="email" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Jabatan Akademik</span>
                    </label>
                    <input type="text" id="edit_jabatan" name="jabatan" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                
                <div class="p-6 bg-blue-50 rounded-2xl border-2 border-blue-100">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-blue-800 font-medium italic">Catatan: Mengubah email dosen juga akan memperbarui email login akun yang bersangkutan.</p>
                    </div>
                </div>

                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Perbarui Informasi</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function editDosen(id, nidn, nama, email, prodi_id, jabatan) {
            const form = document.getElementById('form_edit_dosen');
            form.action = `/admin/dosen/${id}`;
            document.getElementById('edit_nidn').value = nidn;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_prodi_id').value = prodi_id;
            document.getElementById('edit_jabatan').value = jabatan;
            modal_edit_dosen.showModal();
        }
    </script>
</x-app>
