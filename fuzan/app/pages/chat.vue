<script setup>
// Import Google Font Inter
useHead({
  link: [
    { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
    { rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: '' },
    { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' }
  ]
})

const config = useRuntimeConfig()
const appName = config.public.appName

// State
const messages = ref([])
const inputMessage = ref('')
const isLoading = ref(false)
const chatContainer = ref(null)

// Auto scroll ke bawah saat ada pesan baru
const scrollToBottom = () => {
  nextTick(() => {
    if (chatContainer.value) {
      chatContainer.value.scrollTop = chatContainer.value.scrollHeight
    }
  })
}

watch(messages, scrollToBottom, { deep: true })
onMounted(scrollToBottom)

// Kirim pesan
const sendMessage = async () => {
  const text = inputMessage.value.trim()
  if (!text || isLoading.value) return

  // Tampilkan pesan user langsung (optimistic UI)
  messages.value.push({ role: 'user', content: text, id: Date.now() })
  inputMessage.value = ''
  isLoading.value = true

  try {
    const data = await $fetch('/api/chat', {
      method: 'POST',
      body: { message: text }
    })

    messages.value.push({ role: 'assistant', content: data.reply, id: Date.now() + 1 })
  } catch (err) {
    messages.value.push({
      role: 'assistant',
      content: '⚠️ Terjadi kesalahan. Pastikan API key OpenRouter sudah benar.',
      id: Date.now() + 1
    })
  } finally {
    isLoading.value = false
  }
}

// Kirim dengan Enter
const handleKeydown = (e) => {
  if (e.key === 'Enter' && !e.shiftKey) {
    e.preventDefault()
    sendMessage()
  }
}

// Format waktu
const formatTime = (dateStr) => {
  if (!dateStr) return ''
  const d = new Date(dateStr)
  return d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
}
</script>

<template>
  <div class="flex h-screen bg-gray-950 font-sans text-white overflow-hidden">

    <!-- Sidebar -->
    <aside class="hidden md:flex flex-col w-64 bg-gray-900 border-r border-gray-800">
      <!-- Logo -->
      <div class="flex items-center gap-3 px-5 py-5 border-b border-gray-800">
        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-lg shadow-primary-900/50">
          <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
          </svg>
        </div>
        <div>
          <h1 class="text-sm font-bold text-white">{{ appName }}</h1>
          <p class="text-xs text-gray-500">Powered by OpenRouter</p>
        </div>
      </div>

      <!-- New Chat Button -->
      <div class="p-4">
        <button
          @click="() => { messages = [] }"
          class="w-full flex items-center gap-2 px-3 py-2.5 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium transition-colors duration-200"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Chat Baru
        </button>
      </div>

      <!-- Spacer -->
      <div class="flex-1" />

      <!-- Footer Sidebar -->
      <div class="p-4 border-t border-gray-800">
        <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-800 cursor-pointer transition-colors">
          <div class="w-7 h-7 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-xs font-bold">
            U
          </div>
          <div>
            <p class="text-xs font-medium text-gray-300">Pengguna</p>
            <p class="text-xs text-gray-600">user@example.com</p>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col min-w-0">

      <!-- Top Bar -->
      <header class="flex items-center justify-between px-5 py-4 border-b border-gray-800 bg-gray-900/50 backdrop-blur-sm">
        <div class="flex items-center gap-3">
          <!-- Mobile Logo -->
          <div class="flex md:hidden items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
            </div>
            <span class="text-sm font-bold text-white">{{ appName }}</span>
          </div>
          <div class="hidden md:block">
            <h2 class="text-sm font-semibold text-white">Percakapan Baru</h2>
          </div>
        </div>

        <!-- Model Badge -->
        <div class="flex items-center gap-2 bg-gray-800 border border-gray-700 px-3 py-1.5 rounded-full">
          <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse" />
          <span class="text-xs text-gray-300 font-medium">openrouter/auto</span>
        </div>
      </header>

      <!-- Chat Messages -->
      <div
        ref="chatContainer"
        class="flex-1 overflow-y-auto px-4 py-6 space-y-4 scroll-smooth"
        style="scrollbar-width: thin; scrollbar-color: #374151 transparent;"
      >
        <!-- Empty State -->
        <div v-if="messages.length === 0" class="flex flex-col items-center justify-center h-full text-center px-4">
          <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center mb-4 shadow-xl shadow-primary-900/40">
            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-white mb-2">Mulai Percakapan</h3>
          <p class="text-gray-500 text-sm max-w-xs">Ketik pesan di bawah untuk mulai chat dengan AI. Semua percakapan tersimpan otomatis.</p>
        </div>

        <!-- Messages List -->
        <template v-else>
          <div
            v-for="msg in messages"
            :key="msg.id"
            class="flex animate-fade-in"
            :class="msg.role === 'user' ? 'justify-end' : 'justify-start'"
          >
            <!-- AI Avatar -->
            <div v-if="msg.role === 'assistant'" class="flex-shrink-0 mr-3">
              <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-md">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
              </div>
            </div>

            <!-- Bubble -->
            <div
              class="max-w-[75%] md:max-w-[60%] rounded-2xl px-4 py-3 shadow-sm"
              :class="msg.role === 'user'
                ? 'bg-gradient-to-br from-primary-600 to-primary-700 text-white rounded-br-sm'
                : 'bg-gray-800 border border-gray-700 text-gray-100 rounded-bl-sm'"
            >
              <p class="text-sm leading-relaxed whitespace-pre-wrap">{{ msg.content }}</p>
              <p class="text-xs mt-1 opacity-50 text-right">{{ formatTime(msg.createdAt) }}</p>
            </div>

            <!-- User Avatar -->
            <div v-if="msg.role === 'user'" class="flex-shrink-0 ml-3">
              <div class="w-8 h-8 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center text-xs font-bold text-gray-300">
                U
              </div>
            </div>
          </div>
        </template>

        <!-- Loading Indicator -->
        <div v-if="isLoading" class="flex justify-start animate-fade-in">
          <div class="flex-shrink-0 mr-3">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
            </div>
          </div>
          <div class="bg-gray-800 border border-gray-700 rounded-2xl rounded-bl-sm px-4 py-3">
            <div class="flex items-center gap-1.5">
              <span class="w-2 h-2 rounded-full bg-primary-400 animate-bounce" style="animation-delay: 0ms" />
              <span class="w-2 h-2 rounded-full bg-primary-400 animate-bounce" style="animation-delay: 150ms" />
              <span class="w-2 h-2 rounded-full bg-primary-400 animate-bounce" style="animation-delay: 300ms" />
            </div>
          </div>
        </div>
      </div>

      <!-- Input Area -->
      <footer class="px-4 pb-5 pt-3 border-t border-gray-800 bg-gray-900/50 backdrop-blur-sm">
        <div class="max-w-3xl mx-auto">
          <div class="flex items-end gap-3 bg-gray-800 border border-gray-700 rounded-2xl px-4 py-3 focus-within:border-primary-500 transition-colors duration-200">
            <textarea
              v-model="inputMessage"
              @keydown="handleKeydown"
              :disabled="isLoading"
              placeholder="Ketik pesan di sini... (Enter untuk kirim)"
              rows="1"
              class="flex-1 bg-transparent text-sm text-white placeholder-gray-500 resize-none focus:outline-none leading-relaxed"
              style="max-height: 160px; overflow-y: auto;"
              @input="e => { e.target.style.height = 'auto'; e.target.style.height = Math.min(e.target.scrollHeight, 160) + 'px' }"
            />
            <button
              @click="sendMessage"
              :disabled="isLoading || !inputMessage.trim()"
              class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-200"
              :class="inputMessage.trim() && !isLoading
                ? 'bg-primary-600 hover:bg-primary-500 text-white shadow-lg shadow-primary-900/50 scale-100 hover:scale-105'
                : 'bg-gray-700 text-gray-500 cursor-not-allowed'"
            >
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
              </svg>
            </button>
          </div>
          <p class="text-center text-xs text-gray-600 mt-2">AI dapat membuat kesalahan. Periksa informasi penting.</p>
        </div>
      </footer>

    </main>
  </div>
</template>

<style scoped>
textarea {
  scrollbar-width: thin;
  scrollbar-color: #374151 transparent;
}
::-webkit-scrollbar {
  width: 4px;
}
::-webkit-scrollbar-track {
  background: transparent;
}
::-webkit-scrollbar-thumb {
  background: #374151;
  border-radius: 4px;
}
</style>
