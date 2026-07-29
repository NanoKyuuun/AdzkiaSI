<x-app>
    <x-slot:title>Manajemen Fakultas</x-slot:title>
    <x-slot:header>Fakultas</x-slot:header>

    <div class="space-y-6">
        @if(session('success'))
            <div class="flex items-center gap-3 px-4 py-3 rounded bg-status-success-bg text-status-success-text text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-[18px] leading-[26px] font-semibold text-neutral-900">Daftar Fakultas</h2>
                <p class="text-[12px] text-neutral-500 mt-0.5">Kelola dan organisasikan data fakultas universitas.</p>
            </div>
            <button onclick="modal_add_fakultas.showModal()" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Fakultas
            </button>
        </div>

        <div class="bg-neutral-000 rounded-[6px] border border-neutral-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="w-12">No</th>
                            <th>Kode</th>
                            <th>Nama Fakultas</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fakultas as $index => $item)
                        <tr>
                            <td class="text-neutral-500">{{ $index + 1 }}</td>
                            <td>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-[2px] text-[11px] font-medium bg-neutral-050 text-neutral-700">
                                    {{ $item->kode_fakultas }}
                                </span>
                            </td>
                            <td class="text-neutral-900 font-medium">{{ $item->name_fakultas }}</td>
                            <td class="text-right">
                                <div class="flex justify-end gap-1">
                                    <button onclick="editFakultas({{ $item->id }}, '{{ $item->name_fakultas }}', '{{ $item->kode_fakultas }}')"
                                        class="p-2 rounded text-neutral-500 hover:text-brand-cyan-700 hover:bg-neutral-050 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.fakultas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fakultas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded text-neutral-500 hover:text-status-danger-text hover:bg-status-danger-bg transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-16">
                                <p class="text-neutral-500 text-sm">Belum ada data fakultas yang terdaftar.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="modal_add_fakultas" class="modal">
        <div class="modal-box max-w-md">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[16px] font-semibold text-neutral-900">Tambah Fakultas</h3>
                <form method="dialog"><button class="p-1 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></form>
            </div>
            <form action="{{ route('admin.fakultas.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Kode Fakultas</label>
                    <input type="text" name="kode_fakultas" placeholder="Contoh: FTI, FEB" class="input" required />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Nama Fakultas</label>
                    <input type="text" name="name_fakultas" placeholder="Masukkan nama fakultas lengkap" class="input" required />
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200">
                    <button type="button" onclick="modal_add_fakultas.close()" class="btn btn-ghost">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>

    <dialog id="modal_edit_fakultas" class="modal">
        <div class="modal-box max-w-md">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[16px] font-semibold text-neutral-900">Edit Fakultas</h3>
                <form method="dialog"><button class="p-1 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></form>
            </div>
            <form id="form_edit_fakultas" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Kode Fakultas</label>
                    <input type="text" id="edit_kode_fakultas" name="kode_fakultas" class="input" required />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Nama Fakultas</label>
                    <input type="text" id="edit_name_fakultas" name="name_fakultas" class="input" required />
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200">
                    <button type="button" onclick="modal_edit_fakultas.close()" class="btn btn-ghost">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
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
