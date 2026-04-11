// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },

  modules: ['@nuxtjs/tailwindcss'],

  runtimeConfig: {
    // Server-side only (private)
    openRouterApiKey: process.env.OPENROUTER_API_KEY,

    // Public (exposed to client)
    public: {
      appName: process.env.APP_NAME || 'FuzanAI',
      appUrl: process.env.APP_URL || 'http://localhost:3000',
    }
  }
})

