<script setup>
const config = useRuntimeConfig()
const appName = config.public.appName

useHead({
  title: `${appName} - Asisten Cerdas Kampus`,
  meta: [
    { name: 'description', content: 'Asisten AI untuk membantu Anda menemukan informasi dosen dan administrasi kampus dengan mudah dan cepat.' }
  ]
})
</script>

<template>
  <div class="min-h-screen bg-gray-950 text-white font-sans selection:bg-primary-500 selection:text-white overflow-hidden relative">
    
    <!-- Animated Background Blobs -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
      <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-primary-600/20 blur-[120px] animate-pulse" style="animation-duration: 4s;"></div>
      <div class="absolute top-[60%] -right-[10%] w-[40%] h-[60%] rounded-full bg-indigo-600/20 blur-[120px] animate-pulse" style="animation-duration: 5s; animation-delay: 1s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="container mx-auto px-6 py-6 flex items-center justify-between relative z-10">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-primary-900/50 cursor-pointer hover:scale-105 transition-transform">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
          </svg>
        </div>
        <span class="text-xl font-bold tracking-tight">{{ appName }}</span>
      </div>
      <div>
        <NuxtLink 
          to="/chat" 
          class="text-sm font-medium text-gray-300 hover:text-white transition-colors border border-gray-700 hover:border-gray-500 rounded-full px-5 py-2.5 backdrop-blur-sm bg-gray-900/50"
        >
          Masuk
        </NuxtLink>
      </div>
    </nav>

    <!-- Hero Section -->
    <main class="container mx-auto px-6 pt-20 pb-32 flex flex-col items-center justify-center text-center relative z-10 min-h-[80vh]">
      
      <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-900/30 border border-primary-500/30 text-primary-300 text-sm font-medium mb-8 animate-fade-in shadow-[0_0_15px_rgba(99,102,241,0.2)]">
        <span class="w-2 h-2 rounded-full bg-primary-400 animate-pulse"></span>
        Terhubung dengan Database Kampus
      </div>

      <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8 leading-tight animate-fade-in" style="animation-delay: 100ms;">
        Tanya Informasi Dosen,<br />
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-indigo-400">Dalam Hitungan Detik.</span>
      </h1>
      
      <p class="text-lg md:text-xl text-gray-400 mb-12 max-w-2xl leading-relaxed animate-fade-in" style="animation-delay: 200ms;">
        {{ appName }} menggunakan kecerdasan buatan untuk membantu Anda menemukan nama, email, dan nomor telepon dosen tanpa perlu mencari secara manual.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 animate-fade-in" style="animation-delay: 300ms;">
        <NuxtLink 
          to="/chat" 
          class="px-8 py-4 rounded-full bg-gradient-to-r from-primary-600 to-indigo-600 hover:from-primary-500 hover:to-indigo-500 text-white font-semibold text-lg shadow-[0_0_30px_rgba(99,102,241,0.4)] hover:shadow-[0_0_40px_rgba(99,102,241,0.6)] hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group"
        >
          Mulai Chat Sekarang
          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
          </svg>
        </NuxtLink>
      </div>

      <!-- Feature Highlight -->
      <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl animate-fade-in w-full text-left" style="animation-delay: 400ms;">
        <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800 rounded-2xl p-6 hover:border-primary-500/50 transition-colors group">
          <div class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center mb-4 group-hover:bg-primary-900/50 transition-colors">
            <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-100">Respons Cepat</h3>
          <p class="text-gray-400 text-sm">Didukung oleh OpenRouter AI untuk memberikan jawaban instan dan akurat.</p>
        </div>

        <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800 rounded-2xl p-6 hover:border-primary-500/50 transition-colors group">
          <div class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center mb-4 group-hover:bg-primary-900/50 transition-colors">
            <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-100">Data Terintegrasi</h3>
          <p class="text-gray-400 text-sm">Terkoneksi langsung ke database MySQL untuk informasi kontak dosen terkini.</p>
        </div>

        <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800 rounded-2xl p-6 hover:border-primary-500/50 transition-colors group">
          <div class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center mb-4 group-hover:bg-primary-900/50 transition-colors">
            <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-100">Aman & Privat</h3>
          <p class="text-gray-400 text-sm">Histori percakapan Anda disimpan dengan aman dan tidak dibagikan kepada publik.</p>
        </div>
      </div>

    </main>
  </div>
</template>

<style>
/* Utilities for Vue Transitions if needed */
.animate-fade-in {
  animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
