<x-app>
    <x-slot:title>Manajemen FAQ & AI Learning</x-slot:title>
    <x-slot:header>FAQ & AI Learning</x-slot:header>

    <div class="space-y-6">
        @if(session('success'))
            <div class="flex items-center gap-3 px-4 py-3 rounded bg-status-success-bg text-status-success-text text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="flex items-start gap-3 px-4 py-3 rounded bg-status-danger-bg text-status-danger-text text-sm">
                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                <div>
                    <p class="font-medium">Gagal menyimpan data:</p>
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
                <h2 class="text-[18px] leading-[26px] font-semibold text-neutral-900">FAQ & AI Learning</h2>
                <p class="text-[12px] text-neutral-500 mt-0.5">Kelola pertanyaan umum dan pantau kandidat FAQ dari AI.</p>
            </div>
            <button onclick="modal_add_faq.showModal()" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Add FAQ
            </button>
        </div>

        {{-- KPI Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-neutral-000 rounded-lg border border-neutral-200 shadow-soft p-5">
                <p class="text-[11px] font-medium text-neutral-500 uppercase">FAQ Aktif</p>
                <p class="mt-1 text-2xl font-semibold text-neutral-900">{{ $faqs->where('is_active', true)->count() }}</p>
                <p class="mt-1 text-[11px] text-neutral-500">dari {{ $faqs->count() }} total</p>
            </div>
            <div class="bg-neutral-000 rounded-lg border border-status-warning-border shadow-soft p-5">
                <p class="text-[11px] font-medium text-status-warning-text uppercase">Kandidat AI</p>
                <p class="mt-1 text-2xl font-semibold text-status-warning-text">{{ $learningStats['total_suggested'] }}</p>
                <p class="mt-1 text-[11px] text-neutral-500">{{ $learningStats['high_confidence'] }} confidence tinggi</p>
            </div>
            <div class="bg-neutral-000 rounded-lg border border-status-info-border shadow-soft p-5">
                <p class="text-[11px] font-medium text-status-info-text uppercase">Menunggu Review</p>
                <p class="mt-1 text-2xl font-semibold text-status-info-text">{{ $learningStats['total_new'] }}</p>
                <p class="mt-1 text-[11px] text-neutral-500">{{ $learningStats['total_reviewed'] }} sudah ditinjau</p>
            </div>
            <div class="bg-neutral-000 rounded-lg border border-status-success-border shadow-soft p-5">
                <p class="text-[11px] font-medium text-status-success-text uppercase">Terbit dari AI</p>
                <p class="mt-1 text-2xl font-semibold text-status-success-text">{{ $learningStats['total_promoted'] }}</p>
                <p class="mt-1 text-[11px] text-neutral-500">dari {{ $learningStats['total_logs'] }} total log</p>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="bg-neutral-000 rounded-lg border border-neutral-200 overflow-hidden">
            <div class="flex border-b border-neutral-200 px-4">
                <button onclick="showTab('faq')" id="tab-faq" class="px-4 py-3 text-[13px] font-medium border-b-2 border-brand-cyan-700 text-brand-cyan-700">
                    Daftar FAQ ({{ $faqs->count() }})
                </button>
                <button onclick="showTab('log')" id="tab-log" class="px-4 py-3 text-[13px] font-medium border-b-2 border-transparent text-neutral-500 hover:text-neutral-700 transition-colors">
                    AI Learning Queue
                    @if($learningStats['total_suggested'] > 0)
                        <span class="badge badge-warning ml-2">{{ $learningStats['total_suggested'] }}</span>
                    @endif
                </button>
            </div>

            {{-- FAQ Panel --}}
            <div id="panel-faq" class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="w-12">No</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $index => $faq)
                            <tr>
                                <td class="text-neutral-500">{{ $index + 1 }}</td>
                                <td class="max-w-xs">
                                    <p class="text-neutral-900 font-medium text-[12px] leading-snug line-clamp-2">{{ $faq->pertanyaan }}</p>
                                </td>
                                <td class="max-w-sm">
                                    <p class="text-neutral-500 text-[12px] leading-snug line-clamp-2">{{ $faq->jawaban }}</p>
                                </td>
                                <td>
                                    <span class="badge bg-neutral-050 text-neutral-700">{{ $faq->kategori }}</span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.faq.toggle', $faq->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="badge {{ $faq->is_active ? 'badge-success' : 'bg-neutral-050 text-neutral-500' }} cursor-pointer hover:opacity-75 transition-opacity">
                                            {{ $faq->is_active ? 'Enabled' : 'Disabled' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-1">
                                        <button onclick="editFaq({{ $faq->id }}, {{ json_encode($faq->pertanyaan) }}, {{ json_encode($faq->jawaban) }}, {{ json_encode($faq->kategori) }})"
                                            class="p-2 rounded text-neutral-500 hover:text-brand-cyan-700 hover:bg-neutral-050 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </button>
                                        <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded text-neutral-500 hover:text-status-danger-text hover:bg-status-danger-bg transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-16 text-neutral-500 text-sm">Belum ada FAQ tersimpan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Log Panel --}}
            <div id="panel-log" class="hidden">
                <div class="bg-status-warning-bg border-b border-status-warning-border px-5 py-3">
                    <p class="text-[12px] font-medium text-status-warning-text">Log dengan confidence tinggi akan otomatis menjadi kandidat FAQ. Admin cukup terbitkan atau abaikan.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="w-12">No</th>
                                <th>Pertanyaan & Status</th>
                                <th class="text-center w-20">Freq</th>
                                <th class="text-center w-24">Confidence</th>
                                <th>Draft Jawaban</th>
                                <th>Terakhir</th>
                                <th class="text-center w-48">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $index => $log)
                                @php
                                    $statusBadge = match($log->status) {
                                        \App\Models\AiQuestionLog::STATUS_SUGGESTED => 'badge-warning',
                                        \App\Models\AiQuestionLog::STATUS_REVIEWED => 'badge-success',
                                        default => 'badge-info',
                                    };
                                    $confidenceClass = $log->confidence_score >= 80
                                        ? 'text-status-success-text bg-status-success-bg border-status-success-border'
                                        : ($log->confidence_score >= 65 ? 'text-status-warning-text bg-status-warning-bg border-status-warning-border' : 'text-neutral-500 bg-neutral-050 border-neutral-200');
                                @endphp
                                <tr>
                                    <td class="text-neutral-500">{{ $index + 1 }}</td>
                                    <td class="max-w-sm">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="badge bg-neutral-050 text-neutral-700">{{ $log->kategori_topik ?? 'Umum' }}</span>
                                            <span class="badge {{ $statusBadge }}">{{ $log->status }}</span>
                                        </div>
                                        <p class="text-neutral-900 font-medium text-[12px] leading-snug">{{ $log->pertanyaan_user }}</p>
                                        <p class="text-neutral-500 text-[11px] mt-1">{{ $log->topik_ringkas ?: 'Belum ada ringkasan' }}</p>
                                    </td>
                                    <td class="text-center text-[12px] font-medium text-neutral-700">{{ $log->jumlah }}x</td>
                                    <td class="text-center">
                                        <span class="inline-flex flex-col items-center px-2 py-1 rounded border text-[11px] font-medium {{ $confidenceClass }}">
                                            <span class="text-[16px] font-semibold leading-none">{{ $log->confidence_score }}</span>
                                            <span class="text-[9px] uppercase">score</span>
                                        </span>
                                    </td>
                                    <td class="max-w-md">
                                        <p class="text-neutral-500 text-[11px] leading-snug line-clamp-3">{{ $log->jawaban_ai ?: 'Belum ada jawaban.' }}</p>
                                    </td>
                                    <td class="text-[11px] text-neutral-500">
                                        {{ optional($log->last_seen_at ?? $log->updated_at)->diffForHumans() }}
                                    </td>
                                    <td class="text-center">
                                        <div class="flex justify-center gap-1">
                                            @if($log->status === \App\Models\AiQuestionLog::STATUS_SUGGESTED && filled($log->jawaban_ai))
                                                <form action="{{ route('admin.faq.approve-log', $log->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary text-[11px] px-2 h-7">Publish</button>
                                                </form>
                                            @endif
                                            <button onclick="openPromoteModal({{ $log->id }}, {{ json_encode($log->pertanyaan_user) }}, {{ json_encode($log->jawaban_ai) }}, {{ json_encode($log->kategori_topik ?: 'Umum') }})"
                                                class="btn btn-secondary text-[11px] px-2 h-7">Edit</button>
                                            <form action="{{ route('admin.faq.dismiss-log', $log->id) }}" method="POST" onsubmit="return confirm('Tandai log ini sebagai sudah ditinjau?')">
                                                @csrf
                                                <button type="submit" class="btn btn-ghost text-[11px] px-2 h-7">Abaikan</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-16 text-neutral-500 text-sm">Tidak ada log yang menunggu review.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    <dialog id="modal_add_faq" class="modal">
        <div class="modal-box max-w-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[16px] font-semibold text-neutral-900">Tambah FAQ</h3>
                <form method="dialog"><button class="p-1 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></form>
            </div>
            <form action="{{ route('admin.faq.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="input" required />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Jawaban</label>
                    <textarea name="jawaban" rows="4" class="input resize-none" required></textarea>
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Kategori</label>
                    <select name="kategori" class="select" required>
                        <option>Umum</option><option>Akademik</option><option>Pendaftaran</option><option>Biaya</option><option>Program Studi</option><option>Dosen</option><option>Kontak</option><option>Fasilitas</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200">
                    <button type="button" onclick="modal_add_faq.close()" class="btn btn-ghost">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>

    <dialog id="modal_edit_faq" class="modal">
        <div class="modal-box max-w-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[16px] font-semibold text-neutral-900">Edit FAQ</h3>
                <form method="dialog"><button class="p-1 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></form>
            </div>
            <form id="form_edit_faq" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Pertanyaan</label>
                    <input type="text" id="edit_pertanyaan" name="pertanyaan" class="input" required />
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Jawaban</label>
                    <textarea id="edit_jawaban" name="jawaban" rows="4" class="input resize-none" required></textarea>
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Kategori</label>
                    <select id="edit_kategori" name="kategori" class="select" required>
                        <option>Umum</option><option>Akademik</option><option>Pendaftaran</option><option>Biaya</option><option>Program Studi</option><option>Dosen</option><option>Kontak</option><option>Fasilitas</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200">
                    <button type="button" onclick="modal_edit_faq.close()" class="btn btn-ghost">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>

    <dialog id="modal_promote_log" class="modal">
        <div class="modal-box max-w-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[16px] font-semibold text-neutral-900">Edit Draft AI</h3>
                <form method="dialog"><button class="p-1 rounded text-neutral-500 hover:text-neutral-700 hover:bg-neutral-050 transition-colors"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></form>
            </div>
            <form id="form_promote_log" method="POST" class="space-y-4">
                @csrf
                <div class="bg-status-warning-bg border border-status-warning-border rounded p-3">
                    <p class="text-[10px] font-medium uppercase text-status-warning-text mb-1">Pertanyaan dari Pengguna</p>
                    <p id="promote_pertanyaan_display" class="text-[13px] font-medium text-neutral-900"></p>
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Draft Jawaban</label>
                    <textarea name="jawaban" id="promote_jawaban" rows="5" class="input resize-none" required></textarea>
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-neutral-700 mb-1">Kategori</label>
                    <select id="promote_kategori" name="kategori" class="select" required>
                        <option>Umum</option><option>Akademik</option><option>Pendaftaran</option><option>Biaya</option><option>Program Studi</option><option>Dosen</option><option>Kontak</option><option>Fasilitas</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200">
                    <button type="button" onclick="modal_promote_log.close()" class="btn btn-ghost">Cancel</button>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>

    <script>
        function showTab(tab) {
            document.getElementById('panel-faq').classList.toggle('hidden', tab !== 'faq');
            document.getElementById('panel-log').classList.toggle('hidden', tab !== 'log');

            const tabFaq = document.getElementById('tab-faq');
            const tabLog = document.getElementById('tab-log');

            if (tab === 'faq') {
                tabFaq.className = 'px-4 py-3 text-[13px] font-medium border-b-2 border-brand-cyan-700 text-brand-cyan-700';
                tabLog.className = 'px-4 py-3 text-[13px] font-medium border-b-2 border-transparent text-neutral-500 hover:text-neutral-700 transition-colors';
            } else {
                tabLog.className = 'px-4 py-3 text-[13px] font-medium border-b-2 border-brand-cyan-700 text-brand-cyan-700';
                tabFaq.className = 'px-4 py-3 text-[13px] font-medium border-b-2 border-transparent text-neutral-500 hover:text-neutral-700 transition-colors';
            }
        }

        function editFaq(id, pertanyaan, jawaban, kategori) {
            document.getElementById('form_edit_faq').action = `/admin/faq/${id}`;
            document.getElementById('edit_pertanyaan').value = pertanyaan;
            document.getElementById('edit_jawaban').value = jawaban;
            document.getElementById('edit_kategori').value = kategori;
            modal_edit_faq.showModal();
        }

        function openPromoteModal(logId, pertanyaan, jawaban, kategori) {
            document.getElementById('form_promote_log').action = `/admin/faq-log/${logId}/promote`;
            document.getElementById('promote_pertanyaan_display').textContent = pertanyaan;
            document.getElementById('promote_jawaban').value = jawaban || '';
            document.getElementById('promote_kategori').value = kategori || 'Umum';
            modal_promote_log.showModal();
        }

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('tab') === 'log') {
            showTab('log');
        }
    </script>
</x-app>
