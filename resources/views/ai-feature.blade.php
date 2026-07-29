<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FuzanAI – Asisten Kampus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: {
                            50: '#f0f8fd', 100: '#EAF5FB', 200: '#C5E4F4',
                            300: '#8ECCE8', 400: '#43C8E0', 500: '#18B7D8',
                            600: '#178FD1', 700: '#1577B5', 800: '#294C77',
                            900: '#213F66', 950: '#1A3152',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.4s ease both',
                        'slide-up': 'slideUp 0.4s ease both',
                    },
                    keyframes: {
                        fadeIn: { from: { opacity: 0 }, to: { opacity: 1 } },
                        slideUp: { from: { opacity: 0, transform: 'translateY(12px)' }, to: { opacity: 1, transform: 'translateY(0)' } },
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .chat-scrollbar::-webkit-scrollbar { width: 4px; }
        .chat-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .chat-scrollbar::-webkit-scrollbar-thumb { background: #98A7B5; border-radius: 4px; }
        .chat-scrollbar { scrollbar-width: thin; scrollbar-color: #98A7B5 transparent; }
        .prose-ai p { margin-bottom: 0.5rem; }
        .prose-ai ul { list-style: disc; padding-left: 1.25rem; margin-bottom: 0.5rem; }
        .prose-ai li { margin-bottom: 0.25rem; }
        .prose-ai strong { color: #8ECCE8; }
        textarea { field-sizing: content; }
    </style>
</head>
<body class="bg-page text-text-900 font-sans antialiased">

<div x-data="chatApp()" x-init="init()" class="flex h-screen overflow-hidden">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="hidden lg:flex flex-col w-72 flex-shrink-0" style="background-color: #213F66;">

        <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10">
            <div class="w-10 h-10 rounded bg-primary-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-sm font-bold text-white">FuzanAI</h1>
                <p class="text-xs text-white/50">Asisten Akademik Kampus</p>
            </div>
        </div>

        <div class="p-4">
            <button @click="clearChat()"
                class="w-full flex items-center gap-2 px-3 py-2.5 rounded bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Percakapan Baru
            </button>
        </div>

        <div class="px-4 pb-2">
            <p class="text-xs text-white/40 uppercase tracking-wider mb-2 font-semibold">Pertanyaan Populer</p>
            <div class="space-y-1">
                <template x-for="q in suggestions" :key="q">
                    <button @click="askSuggestion(q)"
                        class="w-full text-left text-xs text-white/50 hover:text-white hover:bg-white/10 px-3 py-2 rounded transition-colors truncate">
                        <span x-text="q"></span>
                    </button>
                </template>
            </div>
        </div>

        <div class="flex-1"></div>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-2 text-xs text-white/40">
                <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse flex-shrink-0"></div>
                <span>Powered by OpenRouter AI</span>
            </div>
        </div>
    </aside>

    {{-- ===== MAIN CHAT ===== --}}
    <main class="flex-1 flex flex-col min-w-0 relative bg-page">

        <header class="relative z-10 flex items-center justify-between px-5 py-4 border-b border-border bg-white flex-shrink-0">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded text-text-600 hover:text-text-900 hover:bg-gray-100 transition-all text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="hidden sm:inline">Beranda</span>
                </a>

                <div class="flex lg:hidden items-center gap-2">
                    <div class="w-8 h-8 rounded bg-primary-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-text-900">FuzanAI</span>
                </div>
                <div class="hidden lg:block">
                    <h2 class="text-sm font-semibold text-text-900" x-text="messages.length > 0 ? 'Percakapan Aktif' : 'Percakapan Baru'"></h2>
                    <p class="text-xs text-text-400" x-text="messages.length + ' pesan'"></p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1.5 bg-gray-100 px-3 py-1.5 rounded-full">
                    <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse flex-shrink-0"></div>
                    <span class="text-xs text-text-600 font-medium">OpenRouter</span>
                </div>
                <button @click="clearChat()" class="lg:hidden p-2 rounded hover:bg-gray-100 text-text-400 hover:text-text-900 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
            </div>
        </header>

        <div id="chat-container" class="relative z-10 flex-1 overflow-y-auto chat-scrollbar px-4 py-6 space-y-5">

            {{-- Welcome Screen --}}
            <div x-show="messages.length === 0" x-transition:enter="animate-fade-in" class="flex flex-col items-center justify-center min-h-full text-center px-4 py-10">
                <div class="w-20 h-20 rounded bg-primary-500 flex items-center justify-center mb-5">
                    <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-text-900 mb-2">Halo! Saya FuzanAI</h3>
                <p class="text-text-600 text-sm max-w-sm mb-8 leading-relaxed">
                    Asisten cerdas yang terhubung langsung ke database kampus. Tanya apa saja tentang dosen, prodi, mahasiswa, atau informasi akademik lainnya.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-lg w-full">
                    <template x-for="q in suggestions" :key="q">
                        <button @click="askSuggestion(q)"
                            class="text-left px-4 py-3 rounded bg-white border border-border hover:border-primary-500 hover:bg-primary-100 transition-all group">
                            <p class="text-sm text-text-600 group-hover:text-text-900 transition-colors" x-text="q"></p>
                        </button>
                    </template>
                </div>
            </div>

            {{-- Chat Bubbles --}}
            <template x-for="(msg, index) in messages" :key="index">
                <div class="flex animate-slide-up" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">

                    <div x-show="msg.role === 'assistant'" class="flex-shrink-0 mr-3 mt-1">
                        <div class="w-8 h-8 rounded bg-primary-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="group max-w-[78%] md:max-w-[65%]">
                        <div class="rounded px-4 py-3"
                            :class="msg.role === 'user'
                                ? 'bg-primary-600 text-white rounded-br-sm'
                                : 'bg-white border border-border text-text-900 rounded-bl-sm'">
                            <div class="text-sm leading-relaxed whitespace-pre-wrap prose-ai" x-html="formatText(msg.content)"></div>
                        </div>
                        <p class="text-xs text-text-400 mt-1 px-1" :class="msg.role === 'user' ? 'text-right' : 'text-left'" x-text="msg.time"></p>
                    </div>

                    <div x-show="msg.role === 'user'" class="flex-shrink-0 ml-3 mt-1">
                        <div class="w-8 h-8 rounded bg-gray-200 flex items-center justify-center text-xs font-bold text-text-600">
                            U
                        </div>
                    </div>
                </div>
            </template>

            {{-- Loading Bubble --}}
            <div x-show="isLoading" x-cloak class="flex justify-start animate-fade-in">
                <div class="flex-shrink-0 mr-3 mt-1">
                    <div class="w-8 h-8 rounded bg-primary-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </div>
                </div>
                <div class="bg-white border border-border rounded rounded-bl-sm px-4 py-3">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-primary-500 opacity-30 animate-bounce"></span>
                        <span class="w-2 h-2 rounded-full bg-primary-500 opacity-30 animate-bounce" style="animation-delay:0.15s"></span>
                        <span class="w-2 h-2 rounded-full bg-primary-500 opacity-30 animate-bounce" style="animation-delay:0.3s"></span>
                    </div>
                </div>
            </div>

            <div x-show="errorMsg" x-cloak class="flex justify-center animate-fade-in">
                <div class="flex items-center gap-2 bg-red-50 border border-red-200 px-4 py-2.5 rounded text-sm text-red-600">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span x-text="errorMsg"></span>
                </div>
            </div>

        </div>

        <footer class="relative z-10 px-4 pb-5 pt-3 border-t border-border bg-white flex-shrink-0">
            <div class="max-w-3xl mx-auto">
                <div class="flex items-end gap-3 bg-gray-50 border rounded px-4 py-3 transition-colors duration-200"
                    :class="isFocused ? 'border-primary-500' : 'border-border'">
                    <textarea
                        id="chat-input"
                        x-model="inputText"
                        @keydown.enter.prevent="!$event.shiftKey && sendMessage()"
                        @focus="isFocused = true"
                        @blur="isFocused = false"
                        :disabled="isLoading"
                        placeholder="Tanya apa saja tentang kampus... (Enter untuk kirim)"
                        rows="1"
                        class="flex-1 bg-transparent text-sm text-text-900 placeholder-text-400 resize-none focus:outline-none leading-relaxed min-h-[24px] max-h-40 overflow-y-auto"
                        style="scrollbar-width: thin; scrollbar-color: #98A7B5 transparent;"
                        @input="autoResize($event)"
                    ></textarea>

                    <button
                        @click="sendMessage()"
                        :disabled="isLoading || !inputText.trim()"
                        class="flex-shrink-0 w-9 h-9 rounded flex items-center justify-center transition-all duration-200"
                        :class="inputText.trim() && !isLoading
                            ? 'bg-primary-500 hover:bg-primary-600 text-white'
                            : 'bg-gray-200 text-text-400 cursor-not-allowed'">
                        <svg x-show="!isLoading" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        <svg x-show="isLoading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-center text-xs text-text-400 mt-2">
                    FuzanAI terhubung ke database kampus secara real-time · Tekan <kbd class="bg-gray-100 px-1 rounded text-text-600">Enter</kbd> untuk kirim
                </p>
            </div>
        </footer>
    </main>

</div>

<script>
function chatApp() {
    return {
        messages: [],
        inputText: '',
        isLoading: false,
        errorMsg: '',
        isFocused: false,
        suggestions: @json($suggestions),

        init() {
            this.scrollToBottom();
        },

        getTime() {
            return new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        },

        async sendMessage() {
            const text = this.inputText.trim();
            if (!text || this.isLoading) return;

            this.errorMsg = '';
            this.messages.push({ role: 'user', content: text, time: this.getTime() });
            this.inputText = '';
            this.isLoading = true;
            this.$nextTick(() => this.scrollToBottom());

            const textarea = document.getElementById('chat-input');
            if (textarea) textarea.style.height = 'auto';

            const history = this.messages.slice(0, -1).map(m => ({
                role: m.role,
                content: m.content
            }));

            try {
                const response = await fetch('/ai/ask', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ prompt: text, history: history })
                });

                const data = await response.json();

                if (data.success) {
                    this.messages.push({ role: 'assistant', content: data.result, time: this.getTime() });
                } else {
                    this.errorMsg = 'Gagal: ' + (data.message || 'Terjadi kesalahan pada server AI.');
                }
            } catch (err) {
                this.errorMsg = 'Tidak dapat terhubung ke server. Pastikan Nuxt (fuzan) sedang berjalan.';
            } finally {
                this.isLoading = false;
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        askSuggestion(q) {
            this.inputText = q;
            this.$nextTick(() => this.sendMessage());
        },

        clearChat() {
            this.messages = [];
            this.errorMsg = '';
            this.inputText = '';
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const container = document.getElementById('chat-container');
                if (container) container.scrollTop = container.scrollHeight;
            });
        },

        autoResize(event) {
            const el = event.target;
            el.style.height = 'auto';
            el.style.height = Math.min(el.scrollHeight, 160) + 'px';
        },

        formatText(text) {
            if (!text) return '';
            return text
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/\n/g, '<br>');
        }
    }
}
</script>

</body>
</html>
