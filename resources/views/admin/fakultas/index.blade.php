<x-app>
    <x-slot:title>Manajemen Fakultas</x-slot:title>
    <x-slot:header>Fakultas</x-slot:header>

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
                <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-1">Daftar Fakultas</h1>
                <p class="text-slate-500 font-medium">Kelola dan organisasikan data fakultas universitas.</p>
            </div>
            <button onclick="modal_add_fakultas.showModal()" class="btn btn-primary btn-lg px-8 shadow-lg shadow-primary/20 font-bold group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-125 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Fakultas
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-base-100 rounded-3xl border-2 border-base-300 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-lg w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b-2 border-base-200">
                            <th class="py-6 text-slate-900 font-black uppercase tracking-wider text-xs">No</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Kode</th>
                            <th class="text-slate-900 font-black uppercase tracking-wider text-xs">Nama Fakultas</th>
                            <th class="text-center text-slate-900 font-black uppercase tracking-wider text-xs">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($fakultas as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-all duration-200">
                            <td class="font-black text-slate-400 text-sm">{{ $index + 1 }}</td>
                            <td>
                                <span class="badge badge-lg bg-slate-900 text-white font-mono font-bold px-4 py-3 border-none rounded-lg">
                                    {{ $item->kode_fakultas }}
                                </span>
                            </td>
                            <td class="font-bold text-slate-900 text-lg">{{ $item->name_fakultas }}</td>
                            <td>
                                <div class="flex justify-center gap-3">
                                    <button onclick="editFakultas({{ $item->id }}, '{{ $item->name_fakultas }}', '{{ $item->kode_fakultas }}')" 
                                        class="btn btn-square btn-md btn-ghost border-2 border-transparent hover:border-blue-200 hover:bg-blue-50 text-blue-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.fakultas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fakultas ini?')">
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
                            <td colspan="4" class="text-center py-20">
                                <div class="flex flex-col items-center">
                                    <div class="bg-slate-100 p-6 rounded-full mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-bold italic">Belum ada data fakultas yang terdaftar.</p>
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
    <dialog id="modal_add_fakultas" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Tambah Fakultas</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form action="{{ route('admin.fakultas.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Kode Fakultas</span>
                    </label>
                    <input type="text" name="kode_fakultas" placeholder="Contoh: FT, FEB, FISIP" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Nama Fakultas Lengkap</span>
                    </label>
                    <input type="text" name="name_fakultas" placeholder="Masukkan nama fakultas" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Simpan Data Fakultas</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="modal_edit_fakultas" class="modal">
        <div class="modal-box p-0 overflow-hidden rounded-3xl border-2 border-base-300 shadow-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <h3 class="font-black text-2xl tracking-tight">Edit Informasi Fakultas</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-white">✕</button>
                </form>
            </div>
            <form id="form_edit_fakultas" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Kode Fakultas</span>
                    </label>
                    <input type="text" id="edit_kode_fakultas" name="kode_fakultas" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="form-control w-full">
                    <label class="label mb-1">
                        <span class="label-text font-black text-slate-900 uppercase tracking-widest text-xs">Nama Fakultas</span>
                    </label>
                    <input type="text" id="edit_name_fakultas" name="name_fakultas" 
                        class="input input-bordered input-lg w-full font-bold focus:ring-4 focus:ring-primary/20 border-2" required />
                </div>
                <div class="modal-action pt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block font-black shadow-lg">Perbarui Informasi</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function editFakultas(id, name, kode) {
            const form = document.getElementById('form_edit_fakultas');
            form.action = `/admin/fakultas/${id}`;
            document.getElementById('edit_name_fakultas').value = name;
            document.getElementById('edit_kode_fakultas').value = kode;
            modal_edit_fakultas.showModal();
        }
    </script>
</x-app>
