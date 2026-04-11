import OpenAI from 'openai'

export default defineEventHandler(async (event) => {
  const body = await readBody(event)
  const { message, history = [], dosenContext = '' } = body

  if (!message || !message.trim()) {
    throw createError({ statusCode: 400, message: 'Message tidak boleh kosong' })
  }

  const config = useRuntimeConfig()

  // System prompt yang menyertakan data dosen (jika dikirim oleh Laravel)
  const systemPrompt = `Kamu adalah asisten AI yang bernama fauzan AI yang membantu mahasiswa mendapatkan informasi tentang dosen.
Berikut adalah daftar dosen yang relevan:

${dosenContext || 'Belum ada data dosen spesifik yang diberikan.'}

Gunakan data di atas untuk menjawab pertanyaan pengguna tentang dosen.
Jika pengguna menanyakan informasi yang tidak ada dalam data, jawab dengan jujur bahwa data tersebut tidak tersedia.
Selain pertanyaan tentang dosen, kamu juga bisa membantu pertanyaan umum lainnya.
Jawab dalam Bahasa Indonesia yang ramah dan sopan.`

  // Format pesan untuk AI: System prompt + Riwayat + Pesan baru
  const chatMessages = [
    { role: 'system', content: systemPrompt },
    ...history.map((msg) => ({
      role: msg.role, // "user" atau "assistant"
      content: msg.content
    })),
    { role: 'user', content: message.trim() }
  ]

  // Kirim ke OpenRouter
  const client = new OpenAI({
    baseURL: 'https://openrouter.ai/api/v1',
    apiKey: config.openRouterApiKey,
    defaultHeaders: {
      'HTTP-Referer': config.public.appUrl,
      'X-Title': config.public.appName
    }
  })

  try {
    const completion = await client.chat.completions.create({
      model: 'openrouter/auto',
      messages: chatMessages
    })

    const aiReply = completion.choices[0].message.content

    // Langsung kembalikan balasan tanpa menyimpan ke database
    return { reply: aiReply }
  } catch (error) {
    console.error('AI Error:', error)
    throw createError({ statusCode: 500, message: 'Gagal mendapatkan respon dari AI' })
  }
})
