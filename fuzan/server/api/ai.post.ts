import { OpenAI } from "openai";

export default defineEventHandler(async (event) => {
  const body = await readBody(event);
  const {
    prompt,
    history             = [],
    konteks_fakultas    = [],
    konteks_prodi       = [],
    konteks_dosen       = [],
    konteks_faq         = [],
    konteks_mk          = [],
    konteks_kelas       = [],
    konteks_info        = [],
    konteks_kalender    = [],
    konteks_log         = [],
    konteks_alias       = [],
  } = body;

  let kb = `Kamu adalah FuzanAI, Asisten Informasi Resmi Universitas Adzkia.
Tugas Anda adalah membantu pengguna mendapatkan informasi akurat tentang kampus, termasuk fakultas, program studi, daftar dosen, mata kuliah, jadwal kelas, kalender akademik, biaya kuliah, dan informasi umum kampus.
Gunakan data di bawah ini sebagai sumber utama jawaban Anda. Jika data tersedia di sini, sampaikan kepada pengguna.\n\n`;

  kb += `=== FAKULTAS ===\n${konteks_fakultas.map((f: any) => `- ${f.nama}`).join("\n")}\n\n`;
  kb += `=== PROGRAM STUDI ===\n${konteks_prodi.map((p: any) => `- ${p.nama} (Fakultas: ${p.fakultas})`).join("\n")}\n\n`;
  kb += `=== DOSEN ===\n${konteks_dosen.map((d: any) => `- ${d.nama} (NIDN: ${d.nidn}) | Prodi: ${d.prodi} | Jabatan: ${d.jabatan}`).join("\n")}\n\n`;
  kb += `=== MATA KULIAH ===\n${konteks_mk.map((m: any) => `- ${m.kode} ${m.nama} (${m.sks} SKS, Sem ${m.semester}) | Prodi: ${m.prodi}`).join("\n")}\n\n`;
  kb += `=== KELAS ===\n${konteks_kelas.map((k: any) => `- ${k.nama_kelas} | MK: ${k.mata_kuliah} | Dosen: ${k.dosen} | ${k.tahun_ajaran}`).join("\n")}\n\n`;
  kb += `=== INFORMASI KAMPUS ===\n${konteks_info.map((i: any) => `- ${i.key}: ${i.value}`).join("\n")}\n\n`;
  kb += `=== KALENDER AKADEMIK ===\n${konteks_kalender.map((k: any) => `- ${k.acara}: ${k.mulai}${k.selesai ? " - "+k.selesai : ""} (${k.kategori})`).join("\n")}\n\n`;
  kb += `=== FAQ ===\n${konteks_faq.map((f: any) => `[${f.kategori}] ${f.pertanyaan}\nJawab: ${f.jawaban}`).join("\n\n")}\n\n`;
  kb += `=== PADANAN ISTILAH ===\n${konteks_alias.map((a: any) => `- "${a.observed_term}" = "${a.canonical_term}" (${a.category})`).join("\n")}\n\n`;
  kb += `=== RIWAYAT PERTANYAAN SERUPA ===\n${konteks_log.map((log: any) => `Tanya: ${log.pertanyaan}\nJawab: ${log.jawaban}`).join("\n\n")}\n\n`;

  const systemMessage = `${kb}
ATURAN JAWABAN:
- Jawab dalam Bahasa Indonesia yang ramah, santun, dan informatif.
- Jawablah dengan mengacu pada UNIVERSITAS ADZKIA.
- Gunakan data === MATA KULIAH === untuk menjawab pertanyaan tentang kurikulum, SKS, dan semester.
- Gunakan data === KELAS === untuk menjawab tentang jadwal kelas dan pengajar.
- Gunakan data === INFORMASI KAMPUS === untuk pertanyaan tentang rektor, alamat, visi misi, akreditasi, dll.
- Gunakan data === KALENDER AKADEMIK === untuk pertanyaan tentang jadwal UTS, UAS, libur, pendaftaran.
- Gunakan data === FAQ === untuk pertanyaan biaya, pendaftaran, beasiswa, UKM, fasilitas.
- Gunakan === PADANAN ISTILAH === untuk menyamakan istilah user dengan istilah resmi.
- Jika riwayat bertentangan dengan data resmi, abaikan riwayat.
- Jika data tidak ditemukan, katakan tidak tahu dan sarankan hubungi Admin/Humas Universitas Adzkia.
- Jangan memberikan informasi di luar data yang disediakan.`;

  const chatMessages: any[] = [
    { role: "system", content: systemMessage },
    ...history.map((h: any) => ({ role: h.role, content: h.content })),
    { role: "user", content: prompt },
  ];

  const openai = new OpenAI({
    baseURL: "https://openrouter.ai/api/v1",
    apiKey: process.env.OPENROUTER_API_KEY,
  });

  try {
    const completion = await openai.chat.completions.create({
      model: "openrouter/free",
      messages: chatMessages,
      temperature: 0.2,
    });
    return { success: true, result: completion.choices[0].message.content };
  } catch (error: any) {
    return { success: false, message: error.message };
  }
});
