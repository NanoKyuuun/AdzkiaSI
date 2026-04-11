import { OpenAI } from "openai";

export default defineEventHandler(async (event) => {
  const body = await readBody(event);
  const {
    prompt,
    history          = [],
    konteks_dosen    = [],
    konteks_prodi    = [],
    konteks_mahasiswa = [],
  } = body;

  // ── DEBUG LOG ──────────────────────────────────────────
  console.log("\n======= AI REQUEST MASUK =======");
  console.log("PROMPT  :", prompt);
  console.log("HISTORY :", history.length, "pesan sebelumnya");
  console.log("DOSEN   :", konteks_dosen.length, "data");
  console.log("PRODI   :", konteks_prodi.length, "data");
  console.log("MHSW    :", konteks_mahasiswa.length, "kelompok prodi");
  console.log("=================================\n");

  // ── BANGUN SYSTEM PROMPT ────────────────────────────────
  let systemMessage = `Kamu adalah FuzanAI, asisten akademik cerdas yang terhubung ke database kampus secara real-time.
Jawab dalam Bahasa Indonesia yang ramah, sopan, dan to-the-point.
Jika pertanyaan tidak berkaitan dengan data kampus, tetap bantu sewajarnya.
Jangan pernah bilang data "hanya contoh" — semua data di bawah adalah data nyata dari database kampus.\n\n`;

  // Blok data dosen
  if (konteks_dosen.length > 0) {
    const listDosen = konteks_dosen
      .map((d: any) => `  • ${d.nama} | Prodi: ${d.prodi} | Jabatan: ${d.jabatan} | NIDN: ${d.nidn} | Email: ${d.email}`)
      .join("\n");
    systemMessage += `=== DATA DOSEN (${konteks_dosen.length} dosen) ===\n${listDosen}\n\n`;
  } else {
    systemMessage += `=== DATA DOSEN ===\n  (Belum ada data dosen di database)\n\n`;
  }

  // Blok data program studi
  if (konteks_prodi.length > 0) {
    const listProdi = konteks_prodi
      .map((p: any) => `  • ${p.nama_prodi} (${p.jenjang}) | Kode: ${p.kode_prodi} | Fakultas: ${p.fakultas}`)
      .join("\n");
    systemMessage += `=== PROGRAM STUDI (${konteks_prodi.length} prodi) ===\n${listProdi}\n\n`;
  }

  // Blok data mahasiswa
  if (konteks_mahasiswa.length > 0) {
    const listMhs = konteks_mahasiswa
      .map((m: any) => `  • ${m.prodi}: ${m.jumlah} mahasiswa (${m.aktif} aktif)`)
      .join("\n");
    systemMessage += `=== STATISTIK MAHASISWA ===\n${listMhs}\n\n`;
  }

  systemMessage += `Gunakan data di atas sebagai referensi utama. Jika data yang ditanya tidak ada, katakan dengan jujur.`;

  // ── BANGUN MESSAGES DENGAN HISTORY ─────────────────────
  const chatMessages: any[] = [
    { role: "system", content: systemMessage },
    // Sertakan riwayat percakapan sebelumnya
    ...history.map((h: any) => ({ role: h.role, content: h.content })),
    // Pesan user terbaru
    { role: "user", content: prompt },
  ];

  // ── KIRIM KE OPENROUTER ─────────────────────────────────
  const openai = new OpenAI({
    baseURL: "https://openrouter.ai/api/v1",
    apiKey: process.env.OPENROUTER_API_KEY,
  });

  try {
    const completion = await openai.chat.completions.create({
      model: "google/gemini-2.0-flash-001",
      messages: chatMessages,
      temperature: 0.2,
    });

    const result = completion.choices[0].message.content;
    console.log("AI RESPONSE OK, panjang:", result?.length, "karakter");

    return { success: true, result };

  } catch (error: any) {
    console.error("OpenRouter Error:", error.message);
    return { success: false, message: error.message };
  }
});
