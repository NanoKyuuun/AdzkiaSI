<x-app>
    <x-slot:title>Ringkasan Dashboard Admin</x-slot:title>
    <x-slot:header>Dashboard</x-slot:header>

    <div class="space-y-6">

        {{-- KPI Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-neutral-000 rounded-lg border border-neutral-200 shadow-soft p-5">
                <p class="text-[11px] font-medium text-neutral-500 uppercase">Fakultas</p>
                <p class="mt-1 text-2xl font-semibold text-neutral-900">{{ $stats['total_fakultas'] }}</p>
            </div>
            <div class="bg-neutral-000 rounded-lg border border-neutral-200 shadow-soft p-5">
                <p class="text-[11px] font-medium text-neutral-500 uppercase">Program Studi</p>
                <p class="mt-1 text-2xl font-semibold text-neutral-900">{{ $stats['total_prodi'] }}</p>
            </div>
            <div class="bg-neutral-000 rounded-lg border border-neutral-200 shadow-soft p-5">
                <p class="text-[11px] font-medium text-neutral-500 uppercase">Dosen</p>
                <p class="mt-1 text-2xl font-semibold text-neutral-900">{{ $stats['total_dosen'] }}</p>
            </div>
            <div class="bg-neutral-000 rounded-lg border border-neutral-200 shadow-soft p-5">
                <p class="text-[11px] font-medium text-neutral-500 uppercase">Interaksi AI</p>
                <p class="mt-1 text-2xl font-semibold text-neutral-900">{{ $stats['total_pertanyaan_ai'] }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- FAQ Candidates --}}
            <div class="xl:col-span-2 bg-neutral-000 rounded-lg border border-neutral-200 overflow-hidden shadow-soft">
                <div class="flex items-center justify-between px-5 py-4 border-b border-neutral-200">
                    <div>
                        <h2 class="text-[16px] font-semibold text-neutral-900">Kandidat FAQ</h2>
                        <p class="text-[12px] text-neutral-500 mt-0.5">Berdasarkan frekuensi & confidence score</p>
                    </div>
                    <a href="{{ route('admin.faq.index', ['tab' => 'log']) }}" class="btn btn-ghost text-xs">Lihat semua</a>
                </div>

                <div class="divide-y divide-neutral-200">
                    @forelse($priorityLogs as $log)
                        <div class="px-5 py-4 transition-colors hover:bg-neutral-025">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="badge
                                    {{ $log->status == \App\Models\AiQuestionLog::STATUS_SUGGESTED ? 'badge-warning' : '' }}
                                    {{ $log->status == \App\Models\AiQuestionLog::STATUS_REVIEWED ? 'badge-success' : '' }}
                                    {{ !in_array($log->status, [\App\Models\AiQuestionLog::STATUS_SUGGESTED, \App\Models\AiQuestionLog::STATUS_REVIEWED]) ? 'badge-info' : '' }}">
                                    {{ $log->status }}
                                </span>
                                <span class="text-[11px] text-neutral-500">{{ $log->kategori_topik ?: 'Umum' }}</span>
                                <span class="text-[11px] text-neutral-500">· {{ $log->jumlah }}x</span>
                            </div>
                            <p class="text-sm font-medium text-neutral-900">{{ $log->pertanyaan_user }}</p>
                            @if($log->jawaban_ai)
                                <p class="text-xs text-neutral-500 mt-0.5 line-clamp-2">{{ $log->jawaban_ai }}</p>
                            @endif
                            <div class="mt-1.5 inline-flex items-center gap-1 text-xs font-medium
                                {{ $log->confidence_score >= 80 ? 'text-status-success-text' : ($log->confidence_score >= 65 ? 'text-status-warning-text' : 'text-neutral-500') }}">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                {{ $log->confidence_score }}%
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-10 text-center text-sm text-neutral-500">Belum ada kandidat FAQ yang menunggu review.</div>
                    @endforelse
                </div>
            </div>

            {{-- Right column --}}
            <div class="space-y-6">

                {{-- Learning Stats --}}
                <div class="bg-neutral-000 rounded-lg border border-neutral-200 p-5 shadow-soft">
                    <h3 class="text-sm font-semibold text-neutral-900 mb-4">Status Pembelajaran AI</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-neutral-500">Suggested</p>
                            <p class="text-xl font-semibold text-neutral-900">{{ $learningStats['suggested'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-neutral-500">Pending Review</p>
                            <p class="text-xl font-semibold text-neutral-900">{{ $learningStats['pending_review'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-neutral-500">High Confidence</p>
                            <p class="text-xl font-semibold text-status-success-text">{{ $learningStats['high_confidence'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-neutral-500">Promoted</p>
                            <p class="text-xl font-semibold text-brand-cyan-700">{{ $learningStats['promoted'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Top Topics --}}
                <div class="bg-neutral-000 rounded-lg border border-neutral-200 p-5 shadow-soft">
                    <h3 class="text-sm font-semibold text-neutral-900 mb-3">Topik Populer</h3>
                    @forelse($topTopics as $topic)
                        <div class="flex items-center justify-between py-2 border-b border-neutral-200 last:border-0">
                            <span class="text-sm text-neutral-700">{{ $topic->kategori_topik ?: 'Umum' }}</span>
                            <span class="text-xs font-medium text-neutral-500">{{ (int) $topic->total }}x</span>
                        </div>
                    @empty
                        <p class="text-sm text-neutral-500">Belum ada data.</p>
                    @endforelse
                </div>

                {{-- CTA --}}
                <a href="{{ route('ai.index') }}" class="block bg-brand-cyan-700 rounded-lg p-5 text-white hover:bg-brand-cyan-500 transition-colors shadow-soft">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold">FuzanAI</h3>
                            <p class="text-xs text-white/70 mt-0.5">Uji coba asisten AI kampus</p>
                        </div>
                        <svg class="w-5 h-5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app>
