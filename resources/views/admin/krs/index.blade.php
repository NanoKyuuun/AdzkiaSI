<x-app>
    <x-slot:title>Manajemen KRS Mahasiswa</x-slot:title>
    <x-slot:header>KRS Mahasiswa</x-slot:header>

    <div class="space-y-6">
        <!-- Alert Section -->
        @if(session('success'))
            <div class="alert alert-success shadow-lg border-2 border-success/20 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 bg-base-100 p-8 rounded-3xl border-2 border-base-300 shadow-sm">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-1">Kartu Rencana Studi</h1>
                <p class="text-slate-500 font-medium">Validasi dan kelola pengambilan mata kuliah mahasiswa.</p>
            </div>
            <button onclick="modal_add_krs.showModal()" class="btn btn-primary btn-lg px-8 shadow-lg shadow-primary/20 font-bold group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-125 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Input KRS Baru
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-base-100 rounded-3xl border-2 border-base-300 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-lg w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b-2 border-base-200">
                            <th class="py-6 text-slate-900 font-black uppercase tracking-wider text-xs">No</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Mahasiswa</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Mata Kuliah / Kelas</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">SKS</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Smstr</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Status</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($krs as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-all duration-200">
                            <td class="font-black text-slate-400 text-sm">{{ $index + 1 }}</td>
                            <td>
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-900 text-lg tracking-tight">{{ $item->mahasiswa->nama }}</span>
                                    <span class="text-xs text-slate-500 font-mono font-bold">{{ $item->mahasiswa->nim }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="flex flex-col">
                                    <span class="font-bold text-primary italic">{{ $item->kelas->mataKuliah->nama_mk }}</span>
                                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Kelas: {{ $item->kelas->nama_kelas }} | {{ $item->tahun_ajaran }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-lg badge-outline border-2 border-info text-info font-black px-4">
                                    {{ $item->kelas->mataKuliah->sks }}
                                </span>
                            </td>
                            <td class="text-center font-black text-slate-700">{{ $item->semester }}</td>
                            <td class="text-center">
                                @if($item->status == 'pending')
                                    <span class="badge badge-lg bg-amber-100 text-amber-700 border-2 border-amber-200 font-black uppercase text-[10px] px-4 animate-pulse">
                                        Pending
                                    </span>
                                @elseif($item->status == 'disetujui')
                                    <span class="badge badge-lg bg-emerald-100 text-emerald-700 border-2 border-emerald-200 font-black uppercase text-[10px] px-4">
                                        Disetujui
                                    </span>
                                @else
                                    <span class="badge badge-lg bg-rose-100 text-rose-700 border-2 border-rose-200 font-black uppercase text-[10px] px-4">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center gap-3">
                                    <button onclick="editKrs({{ $item->id }}, {{ $item->mahasiswa_id }}, {{ $item->kelas_id }}, {{ $item->semester }}, '{{ $item->tahun_ajaran }}', '{{ $item->status }}')" 
                                        class="btn btn-square btn-md btn-ghost border-2 border-transparent hover:border-blue-200 hover:bg-blue-50 text-blue-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.krs.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data KRS ini?')">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-bold italic">Belum ada pengajuan KRS mahasiswa.</p>
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
    <dialog id="modal_add_krs" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl w-11/12 max-w-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Input KRS Mahasiswa</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form action="{{ route('admin.krs.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Pilih Mahasiswa</span>
                    </label>
                    <select name="mahasiswa_id" class="select select-bordered select-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required>
                        <option value="" disabled selected>Pilih Mahasiswa</option>
                        @foreach($mahasiswas as $m) 
                            <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->nim }})</option> 
                        @endforeach
                    </select>
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Pilih Mata Kuliah / Kelas</span>
                    </label>
                    <select name="kelas_id" class="select select-bordered select-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        @foreach($kelas as $k) 
                            <option value="{{ $k->id }}">{{ $k->mataKuliah->nama_mk }} - Kelas {{ $k->nama_kelas }} ({{ $k->dosen->nama }})</option> 
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Semester</span>
                        </label>
                        <input type="number" name="semester" min="1" max="14" class="input input-bordered input-lg w-full font-bold border-2" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Tahun Ajaran</span>
                        </label>
                        <input type="text" name="tahun_ajaran" placeholder="2023/2024 Genap" class="input input-bordered input-lg w-full font-bold border-2" required />
                    </div>
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Status Validasi Awal</span>
                    </label>
                    <select name="status" class="select select-bordered select-lg w-full font-bold border-2">
                        <option value="pending" selected>Pending (Butuh Persetujuan)</option>
                        <option value="disetujui">Langsung Setujui</option>
                    </select>
                </div>
                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Simpan Pengajuan KRS</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="modal_edit_krs" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl w-11/12 max-w-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Validasi & Update KRS</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form id="form_edit_krs" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Mahasiswa</span>
                    </label>
                    <select id="edit_mahasiswa_id" name="mahasiswa_id" class="select select-bordered select-lg w-full font-bold opacity-50 pointer-events-none bg-slate-100" readonly>
                        @foreach($mahasiswas as $m) <option value="{{ $m->id }}">{{ $m->nama }}</option> @endforeach
                    </select>
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Mata Kuliah / Kelas</span>
                    </label>
                    <select id="edit_kelas_id" name="kelas_id" class="select select-bordered select-lg w-full font-bold border-2" required>
                        @foreach($kelas as $k) <option value="{{ $k->id }}">{{ $k->mataKuliah->nama_mk }} - Kelas {{ $k->nama_kelas }}</option> @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Semester</span>
                        </label>
                        <input type="number" id="edit_semester" name="semester" class="input input-bordered input-lg w-full font-bold border-2" required />
                    </div>
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Tahun Ajaran</span>
                        </label>
                        <input type="text" id="edit_tahun_ajaran" name="tahun_ajaran" class="input input-bordered input-lg w-full font-bold border-2" required />
                    </div>
                </div>
                <div class="form-control w-full">
                    <label class="label mb-3">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Tindakan Validasi</span>
                    </label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="flex items-center gap-3 p-4 bg-amber-50 rounded-2xl border-2 border-amber-200 cursor-pointer hover:bg-amber-100 transition-colors">
                            <input type="radio" name="status" value="pending" id="status_pending" class="radio radio-warning" />
                            <span class="text-xs font-black text-amber-800">PENDING</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-emerald-50 rounded-2xl border-2 border-emerald-200 cursor-pointer hover:bg-emerald-100 transition-colors">
                            <input type="radio" name="status" value="disetujui" id="status_disetujui" class="radio radio-success" />
                            <span class="text-xs font-black text-emerald-800">SETUJU</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-rose-50 rounded-2xl border-2 border-rose-200 cursor-pointer hover:bg-rose-100 transition-colors">
                            <input type="radio" name="status" value="ditolak" id="status_ditolak" class="radio radio-error" />
                            <span class="text-xs font-black text-rose-800">TOLAK</span>
                        </label>
                    </div>
                </div>
                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Update Status KRS</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function editKrs(id, m_id, k_id, sem, tahun, status) {
            const form = document.getElementById('form_edit_krs');
            form.action = `/admin/krs/${id}`;
            document.getElementById('edit_mahasiswa_id').value = m_id;
            document.getElementById('edit_kelas_id').value = k_id;
            document.getElementById('edit_semester').value = sem;
            document.getElementById('edit_tahun_ajaran').value = tahun;
            document.getElementById('status_' + status).checked = true;
            modal_edit_krs.showModal();
        }
    </script>
</x-app>
