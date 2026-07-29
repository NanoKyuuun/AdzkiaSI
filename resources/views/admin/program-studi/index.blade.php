<x-app>
    <x-slot:title>Manajemen Program Studi</x-slot:title>
    <x-slot:header>Program Studi</x-slot:header>

    <div class="space-y-6">
        @if(session('success'))
            <div class="flex items-center gap-3 px-4 py-3 rounded bg-status-success-bg text-status-success-text text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="flex items-start gap-3 px-4 py-3 rounded bg-status-danger-bg text-status-danger-text text-sm">
                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <div>
                    <p class="font-medium">Gagal menyimpan data! Periksa kembali inputan:</p>
                    <ul class="list-disc list-inside mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-[18px] leading-[26px] font-semibold text-neutral-900">Daftar Program Studi</h2>
                <p class="text-[12px] text-neutral-500 mt-0.5">Kelola data program studi dan jenjang pendidikannya.</p>
            </div>
            <button onclick="modal_add_prodi.showModal()" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Add program
            </button>
        </div>

        <div class="bg-neutral-000 rounded-[6px] border border-neutral-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="w-12">No</th>
                            <th>Kode</th>
                            <th>Nama Prodi</th>
                            <th>Jenjang</th>
                            <th>Fakultas</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programStudi as $index => $item)
                        <tr>
                            <td class="text-neutral-500">{{ $index + 1 }}</td>
                            <td>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-[2px] text-[11px] font-medium bg-neutral-050 text-neutral-700">
                                    {{ $item->kode_prodi }}
                                </span>
                            </td>
                            <td class="text-neutral-900 font-medium">{{ $item->nama_prodi }}</td>
                            <td>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-[2px] text-[11px] font-medium bg-brand-cyan-100 text-brand-cyan-700">
                                    {{ $item->jenjang }}
                                </span>
                            </td>
                            <td class="text-neutral-500">{{ $item->fakultas->name_fakultas }}</td>
                            <td class="text-right">
                                <div class="flex justify-end gap-1">
                                    <button onclick="editProdi({{ $item->id }}, '{{ $item->nama_prodi }}', '{{ $item->kode_prodi }}', '{{ $item->jenjang }}', {{ $item->fakultas_id }})"
                                        class="p-2 rounded text-neutral-500 hover:text-brand-cyan-700 hover:bg-neutral-050 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.program-studi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prodi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded text-neutral-500 hover:text-status-danger-text hover:bg-status-danger-bg transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-16">
                                <p class="text-neutral-500 text-sm">Belum ada data program studi yang terdaftar.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="modal_add_prodi" class="modal">
        <div class="modal-box max-w-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[16px] font-semibold text-neutral-900">Tambah Prodi</h3>
                <form method="dialog">
                    <button class="p-1 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </form>
            </div>
            <form action="{{ route('admin.program-studi.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Fakultas</label>
                    <select name="fakultas_id" class="select" required>
                        <option value="" disabled selected>Pilih Fakultas</option>
                        @foreach($fakultas as $f)
                            <option value="{{ $f->id }}">{{ $f->name_fakultas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-medium text-neutral-700 mb-1">Kode Prodi</label>
                        <input type="text" name="kode_prodi" placeholder="Contoh: IF, SI" class="input" required/>
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-neutral-700 mb-1">Jenjang</label>
                        <select name="jenjang" class="select" required>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1" selected>S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Nama Program Studi</label>
                    <input type="text" name="nama_prodi" placeholder="Masukkan nama prodi lengkap" class="input" required/>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200">
                    <button type="button" onclick="modal_add_prodi.close()" class="btn btn-ghost">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>

    <dialog id="modal_edit_prodi" class="modal">
        <div class="modal-box max-w-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[16px] font-semibold text-neutral-900">Edit Program Studi</h3>
                <form method="dialog">
                    <button class="p-1 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </form>
            </div>
            <form id="form_edit_prodi" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Fakultas</label>
                    <select id="edit_fakultas_id" name="fakultas_id" class="select" required>
                        @foreach($fakultas as $f)
                            <option value="{{ $f->id }}">{{ $f->name_fakultas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-medium text-neutral-700 mb-1">Kode Prodi</label>
                        <input type="text" id="edit_kode_prodi" name="kode_prodi" class="input" required/>
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-neutral-700 mb-1">Jenjang</label>
                        <select id="edit_jenjang" name="jenjang" class="select" required>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Nama Program Studi</label>
                    <input type="text" id="edit_nama_prodi" name="nama_prodi" class="input" required/>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200">
                    <button type="button" onclick="modal_edit_prodi.close()" class="btn btn-ghost">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>

    <script>
        function editProdi(id, nama, kode, jenjang, fakultas_id) {
            const form = document.getElementById('form_edit_prodi');
            form.action = `/admin/program-studi/${id}`;
            document.getElementById('edit_nama_prodi').value = nama;
            document.getElementById('edit_kode_prodi').value = kode;
            document.getElementById('edit_jenjang').value = jenjang;
            document.getElementById('edit_fakultas_id').value = fakultas_id;
            modal_edit_prodi.showModal();
        }

        @if($errors->any() && !session('edit_mode'))
            document.addEventListener('DOMContentLoaded', function() {
                modal_add_prodi.showModal();
            });
        @endif
    </script>
</x-app>
