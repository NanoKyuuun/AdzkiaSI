<x-app>
    <x-slot:title>Manajemen Mata Kuliah</x-slot:title>
    <x-slot:header>Mata Kuliah</x-slot:header>

    <div class="space-y-6">
        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert alert-success shadow-lg border-2 border-success/20 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 bg-base-100 p-8 rounded-3xl border-2 border-base-300 shadow-sm">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-1">Daftar Mata Kuliah</h1>
                <p class="text-slate-500 font-medium">Kelola kurikulum dan bobot SKS tiap mata kuliah.</p>
            </div>
            <button onclick="modal_add_mk.showModal()" class="btn btn-primary btn-lg px-8 shadow-lg shadow-primary/20 font-bold group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-125 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Mata Kuliah
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-base-100 rounded-3xl border-2 border-base-300 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-lg w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b-2 border-base-200">
                            <th class="py-6 text-slate-900 font-black uppercase tracking-wider text-xs">No</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Kode MK</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Nama Mata Kuliah</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">SKS</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Smstr</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Prodi</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($mataKuliah as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-all duration-200">
                            <td class="font-black text-slate-400 text-sm">{{ $index + 1 }}</td>
                            <td>
                                <span class="badge badge-lg bg-slate-900 text-white font-mono font-bold px-4 py-3 border-none rounded-lg">
                                    {{ $item->kode_mk }}
                                </span>
                            </td>
                            <td class="font-bold text-slate-900 text-lg tracking-tight">{{ $item->nama_mk }}</td>
                            <td class="text-center">
                                <span class="badge badge-lg badge-outline border-2 border-info text-info font-black px-4 py-3">
                                    {{ $item->sks }}
                                </span>
                            </td>
                            <td class="text-center font-black text-slate-700 text-lg">{{ $item->semester }}</td>
                            <td class="text-slate-600 font-medium italic text-sm">{{ $item->programStudi->nama_prodi }}</td>
                            <td>
                                <div class="flex justify-center gap-3">
                                    <button onclick="editMK({{ $item->id }}, '{{ $item->kode_mk }}', '{{ $item->nama_mk }}', {{ $item->sks }}, {{ $item->semester }}, {{ $item->prodi_id }})" 
                                        class="btn btn-square btn-md btn-ghost border-2 border-transparent hover:border-blue-200 hover:bg-blue-50 text-blue-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.mata-kuliah.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-bold italic">Belum ada data mata kuliah yang terdaftar.</p>
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
    <dialog id="modal_add_mk" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl w-11/12 max-w-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Tambah Mata Kuliah</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form action="{{ route('admin.mata-kuliah.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Program Studi</span>
                        </label>
                        <select name="prodi_id" class="select select-bordered select-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required>
                            <option value="" disabled selected>Pilih Prodi</option>
                            @foreach($prodi as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Kode Mata Kuliah</span>
                        </label>
                        <input type="text" name="kode_mk" placeholder="Contoh: MK001" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Nama Mata Kuliah</span>
                    </label>
                    <input type="text" name="nama_mk" placeholder="Masukkan nama lengkap mata kuliah" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Jumlah SKS</span>
                        </label>
                        <input type="number" name="sks" min="1" max="6" placeholder="Bobot SKS" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Semester</span>
                        </label>
                        <input type="number" name="semester" min="1" max="8" placeholder="Semester pelaksanaan" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                </div>
                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Simpan Data MK</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="modal_edit_mk" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl w-11/12 max-w-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Edit Mata Kuliah</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form id="form_edit_mk" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Program Studi</span>
                        </label>
                        <select id="edit_prodi_id" name="prodi_id" class="select select-bordered select-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required>
                            @foreach($prodi as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Kode Mata Kuliah</span>
                        </label>
                        <input type="text" id="edit_kode_mk" name="kode_mk" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Nama Mata Kuliah</span>
                    </label>
                    <input type="text" id="edit_nama_mk" name="nama_mk" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Jumlah SKS</span>
                        </label>
                        <input type="number" id="edit_sks" name="sks" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Semester</span>
                        </label>
                        <input type="number" id="edit_semester" name="semester" 
                            class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                    </div>
                </div>
                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Perbarui Informasi</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function editMK(id, kode, nama, sks, semester, prodi_id) {
            const form = document.getElementById('form_edit_mk');
            form.action = `/admin/mata-kuliah/${id}`;
            document.getElementById('edit_kode_mk').value = kode;
            document.getElementById('edit_nama_mk').value = nama;
            document.getElementById('edit_sks').value = sks;
            document.getElementById('edit_semester').value = semester;
            document.getElementById('edit_prodi_id').value = prodi_id;
            modal_edit_mk.showModal();
        }
    </script>
</x-app>
