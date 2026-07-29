<x-app>
    <x-slot:title>Manajemen User</x-slot:title>
    <x-slot:header>Admin</x-slot:header>

    <div class="space-y-6">
        @if(session('success'))
            <div class="flex items-center gap-3 px-4 py-3 rounded bg-status-success-bg text-status-success-text text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flex items-center gap-3 px-4 py-3 rounded bg-status-danger-bg text-status-danger-text text-sm font-medium">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-[18px] leading-[26px] font-semibold text-neutral-900">Daftar Pengguna</h2>
                <p class="text-[12px] text-neutral-500 mt-0.5">Kelola hak akses admin, dosen, dan mahasiswa.</p>
            </div>
            <button onclick="modal_add_user.showModal()" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah User
            </button>
        </div>

        <div class="bg-neutral-000 rounded-[6px] border border-neutral-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="w-12">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td class="text-neutral-500">{{ $index + 1 }}</td>
                            <td class="text-neutral-900 font-medium">{{ $user->name }}</td>
                            <td class="text-neutral-500">{{ $user->email }}</td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge bg-brand-cyan-100 text-brand-cyan-700 capitalize">{{ $user->role }}</span>
                                @elseif($user->role === 'dosen')
                                    <span class="badge bg-status-info-bg text-status-info-text capitalize">{{ $user->role }}</span>
                                @else
                                    <span class="badge bg-status-success-bg text-status-success-text capitalize">{{ $user->role }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-1">
                                    <button onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')"
                                        class="p-2 rounded text-neutral-500 hover:text-brand-cyan-700 hover:bg-neutral-050 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded text-neutral-500 hover:text-status-danger-text hover:bg-status-danger-bg transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="modal_add_user" class="modal">
        <div class="modal-box max-w-md">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[16px] font-semibold text-neutral-900">Tambah User</h3>
                <form method="dialog"><button class="p-1 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></form>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" class="input" required />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Email</label>
                    <input type="email" name="email" class="input" required />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Password</label>
                    <input type="password" name="password" class="input" required />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Role</label>
                    <select name="role" class="select" required>
                        <option value="admin">Admin</option>
                        <option value="dosen">Dosen</option>
                        <option value="mahasiswa" selected>Mahasiswa</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200">
                    <button type="button" onclick="modal_add_user.close()" class="btn btn-ghost">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>

    <dialog id="modal_edit_user" class="modal">
        <div class="modal-box max-w-md">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[16px] font-semibold text-neutral-900">Edit User</h3>
                <form method="dialog"><button class="p-1 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></form>
            </div>
            <form id="form_edit_user" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="edit_user_name" name="name" class="input" required />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Email</label>
                    <input type="email" id="edit_user_email" name="email" class="input" required />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="input" />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Role</label>
                    <select id="edit_user_role" name="role" class="select" required>
                        <option value="admin">Admin</option>
                        <option value="dosen">Dosen</option>
                        <option value="mahasiswa">Mahasiswa</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200">
                    <button type="button" onclick="modal_edit_user.close()" class="btn btn-ghost">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>

    <script>
        function editUser(id, name, email, role) {
            const form = document.getElementById('form_edit_user');
            form.action = `/admin/users/${id}`;
            document.getElementById('edit_user_name').value = name;
            document.getElementById('edit_user_email').value = email;
            document.getElementById('edit_user_role').value = role;
            modal_edit_user.showModal();
        }
    </script>
</x-app>
