# 🎓 KampusKu — Sistem Informasi Akademik + AI Chatbot

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
  <img src="https://img.shields.io/badge/Nuxt.js-3.x-00DC82?style=for-the-badge&logo=nuxtdotjs&logoColor=white"/>
  <img src="https://img.shields.io/badge/OpenRouter-AI-7C3AED?style=for-the-badge&logo=openai&logoColor=white"/>
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/>
  <img src="https://img.shields.io/badge/TailwindCSS-Styling-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white"/>
</p>

> **KampusKu** adalah website sistem informasi akademik kampus berbasis **Laravel** yang dilengkapi dengan **AI Chatbot** bernama **FuzanAI**. AI-nya berjalan di atas **Nuxt.js** (folder `fuzan/`) dan berkomunikasi dengan Laravel melalui HTTP menggunakan pendekatan **Context Passing**.

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Struktur Folder](#-struktur-folder)
- [Arsitektur Sistem](#-arsitektur-sistem)
- [Bagaimana AI Bekerja](#-bagaimana-ai-bekerja-penjelasan-lengkap)
- [ERD (Entity Relationship Diagram)](#-erd-entity-relationship-diagram)
- [Penjelasan Database](#-penjelasan-database)
- [Panduan Instalasi](#-panduan-instalasi)
- [Cara Menjalankan](#-cara-menjalankan)
- [Penjelasan Kode Penting](#-penjelasan-kode-penting)
- [Alur Autentikasi](#-alur-autentikasi)
- [Troubleshooting](#-troubleshooting)

---

## 🏫 Tentang Proyek

Proyek ini dibangun untuk mempelajari bagaimana **Laravel** dan **Nuxt.js** bisa bekerja sama dalam satu ekosistem, dimana:

- **Laravel** → Mengelola data kampus (dosen, mahasiswa, prodi, dll.) + menyajikan halaman web
- **Nuxt.js (fuzan)** → Berperan sebagai **AI Gateway** yang menerima data dari Laravel, meneruskannya ke model AI (via OpenRouter), dan mengembalikan jawaban

Konsep utama yang dipelajari: **Context Passing** — Laravel mengemas data dari database menjadi sebuah "konteks" lalu mengirimkannya ke AI agar AI bisa menjawab pertanyaan berdasarkan data nyata.

---

## ✨ Fitur Utama

### 🌐 Landing Page Publik
| Halaman | URL | Keterangan |
|---|---|---|
| Beranda | `/` | Hero section, tentang kampus, preview fakultas |
| Fakultas | `/fakultas` | Daftar semua fakultas dari database |
| Program Studi | `/program-studi` | Daftar prodi dikelompokkan per fakultas + statistik |
| Kontak | `/kontak` | Form kontak + informasi kampus |

### 🤖 FuzanAI — Chatbot Kampus
| Halaman | URL | Keterangan |
|---|---|---|
| Chat | `/ai` | Chat bubble interface berbasis data kampus real-time |

- AI mengetahui data **dosen**, **program studi**, dan **statistik mahasiswa**
- AI ingat **riwayat percakapan** dalam satu sesi (chat history)
- Tombol shortcut → pertanyaan populer
- Floating button AI di semua halaman

### 🔐 Autentikasi
| Halaman | URL | Keterangan |
|---|---|---|
| Login | `/login` | Login dengan email & password |
| Register | `/register` | Registrasi akun baru (default role: admin) |
| Logout | POST `/logout` | Menghapus sesi pengguna |

### 🛡️ Admin Dashboard
| Modul | URL | Keterangan |
|---|---|---|
| Dashboard | `/admin/dashboard` | Ringkasan data kampus |
| Fakultas | `/admin/fakultas` | CRUD data fakultas |
| Program Studi | `/admin/program-studi` | CRUD data program studi |
| Dosen | `/admin/dosen` | CRUD data dosen |
| Mahasiswa | `/admin/mahasiswa` | CRUD data mahasiswa |
| Mata Kuliah | `/admin/mata-kuliah` | CRUD data mata kuliah |
| Kelas | `/admin/kelas` | CRUD data kelas |
| KRS | `/admin/krs` | CRUD Kartu Rencana Studi |

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi | Fungsi |
|---|---|---|
| **Laravel** | 12.x | Backend utama, routing, database ORM |
| **Nuxt.js** | 3.x | AI Gateway / microservice AI |
| **OpenRouter** | - | Akses ke berbagai model AI (Gemini, GPT, dll.) |
| **Google Gemini 2.0 Flash** | - | Model AI yang digunakan |
| **MySQL** | - | Database utama |
| **Tailwind CSS** | 3.x | Styling utility-first |
| **DaisyUI** | 4.x | Komponen UI berbasis Tailwind |
| **Alpine.js** | 3.x | Interaktivitas JavaScript ringan di frontend |
| **PHP** | 8.3+ | Bahasa backend Laravel |
| **Node.js** | 22+ | Runtime untuk Nuxt.js |

---

## 📁 Struktur Folder

```
deshboard/                          ← ROOT PROJECT LARAVEL
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AiController.php        ← Controller utama AI
│   │   │   ├── AuthController.php      ← Login, Register, Logout
│   │   │   ├── LandingController.php   ← Halaman publik (fakultas, prodi, kontak)
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── DosenController.php
│   │   │       ├── FakultasController.php
│   │   │       ├── MahasiswaController.php
│   │   │       └── ... (CRUD controllers)
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── Dosen.php
│       ├── Mahasiswa.php
│       ├── Fakultas.php
│       ├── ProgramStudi.php
│       ├── MataKuliah.php
│       ├── Kelas.php
│       └── Krs.php
│
├── resources/views/
│   ├── welcome.blade.php               ← Landing page utama
│   ├── ai-feature.blade.php            ← Halaman chat AI
│   ├── fakultas.blade.php              ← Halaman daftar fakultas
│   ├── program-studi.blade.php         ← Halaman daftar prodi
│   ├── kontak.blade.php                ← Halaman kontak
│   ├── layout/
│   │   └── landing.blade.php           ← Layout utama landing page
│   └── components/landing/
│       ├── navbar.blade.php            ← Navigasi
│       ├── hero.blade.php              ← Section hero
│       ├── tentang.blade.php           ← Section tentang kampus
│       ├── fakultas.blade.php          ← Section preview fakultas
│       └── footer.blade.php            ← Footer
│
├── routes/
│   └── web.php                         ← Semua definisi route
│
├── database/migrations/                ← Struktur tabel database
│
└── fuzan/                              ← NUXT.JS — AI GATEWAY
    ├── server/api/
    │   ├── ai.post.ts                  ← ⭐ Endpoint utama AI
    │   └── chat.post.js                ← Endpoint chat alternatif
    ├── app/pages/
    │   ├── index.vue                   ← Landing page Nuxt (tidak dipakai user)
    │   └── chat.vue                    ← Halaman chat Nuxt (tidak dipakai user)
    ├── nuxt.config.ts                  ← Konfigurasi Nuxt
    └── .env                            ← API key OpenRouter
```

---

## 🏗️ Arsitektur Sistem

Berikut gambaran besar bagaimana semua bagian terhubung:

```
┌─────────────────────────────────────────────────────────────┐
│                    BROWSER PENGGUNA                         │
│                  localhost:8000 (Laravel)                   │
└─────────────────────┬───────────────────────────────────────┘
                      │  HTTP Request
                      ▼
┌─────────────────────────────────────────────────────────────┐
│                      LARAVEL                                │
│                                                             │
│  routes/web.php → Controller → View (Blade)                │
│                                                             │
│  Khusus AI:                                                 │
│  POST /ai/ask → AiController::ask()                        │
│    1. Ambil data dari MySQL (Dosen, Prodi, Mahasiswa)       │
│    2. Susun "context" dari data tersebut                    │
│    3. POST ke Nuxt dengan context + prompt + history        │
└─────────────────────┬───────────────────────────────────────┘
                      │  HTTP POST (JSON)
                      │  localhost:3000/api/ai
                      ▼
┌─────────────────────────────────────────────────────────────┐
│               NUXT.JS — FUZAN (AI GATEWAY)                  │
│                                                             │
│  server/api/ai.post.ts                                     │
│    1. Terima context dari Laravel                           │
│    2. Bangun System Prompt dengan data kampus               │
│    3. Kirim ke OpenRouter API                               │
│    4. Kembalikan jawaban ke Laravel                         │
└─────────────────────┬───────────────────────────────────────┘
                      │  HTTPS Request (API Key)
                      ▼
┌─────────────────────────────────────────────────────────────┐
│              OPENROUTER → GEMINI 2.0 FLASH                  │
│                                                             │
│  Model AI menerima system prompt + pertanyaan user          │
│  → Menghasilkan jawaban berdasarkan data kampus             │
└─────────────────────────────────────────────────────────────┘
```

---

## 🤖 Bagaimana AI Bekerja (Penjelasan Lengkap)

Ini adalah inti dari proyek ini. Mari kita telusuri langkah per langkah.

### Langkah 1 — User mengetik pertanyaan di browser

Di `ai-feature.blade.php`, JavaScript menangkap input user:

```javascript
// ai-feature.blade.php — fungsi sendMessage()
const response = await fetch('/ai/ask', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
        prompt: text,      // ← pertanyaan user
        history: history   // ← riwayat chat sebelumnya
    })
});
```

> 💡 **CSRF-TOKEN** adalah keamanan bawaan Laravel yang mencegah serangan dari website lain.

---

### Langkah 2 — Laravel mengambil data dari database

Di `AiController.php`, Laravel mulai bekerja:

```php
// app/Http/Controllers/AiController.php
public function ask(Request $request)
{
    $prompt  = $request->input('prompt');   // pertanyaan user
    $history = $request->input('history', []); // riwayat percakapan

    // === AMBIL DATA DOSEN ===
    // with('programStudi') artinya: ambil juga relasi program studi
    $dosens = Dosen::with('programStudi')->get();

    // Ubah data ke format array sederhana
    $konteksDosen = $dosens->map(fn($d) => [
        'nama'    => $d->nama,
        'prodi'   => optional($d->programStudi)->nama_prodi,
        'jabatan' => $d->jabatan,
        'nidn'    => $d->nidn,
        'email'   => $d->email,
    ])->toArray();

    // === AMBIL DATA PROGRAM STUDI ===
    $prodis = ProgramStudi::with('fakultas')->get();
    $konteksProdi = $prodis->map(fn($p) => [
        'nama_prodi' => $p->nama_prodi,
        'jenjang'    => $p->jenjang,      // S1, S2, D3...
        'kode_prodi' => $p->kode_prodi,
        'fakultas'   => optional($p->fakultas)->name_fakultas,
    ])->toArray();

    // === AMBIL STATISTIK MAHASISWA ===
    // Kelompokkan per prodi, hitung total & yang aktif
    $konteksMahasiswa = Mahasiswa::with('programStudi')
        ->get()
        ->groupBy(fn($m) => optional($m->programStudi)->nama_prodi)
        ->map(fn($group, $prodi) => [
            'prodi'  => $prodi,
            'jumlah' => $group->count(),
            'aktif'  => $group->where('status', 'aktif')->count(),
        ])
        ->values()->toArray();

    // === KIRIM KE NUXT ===
    $response = Http::timeout(60)->post('http://localhost:3000/api/ai', [
        'prompt'            => $prompt,
        'history'           => $history,
        'konteks_dosen'     => $konteksDosen,
        'konteks_prodi'     => $konteksProdi,
        'konteks_mahasiswa' => $konteksMahasiswa,
    ]);
}
```

> 💡 `Http::post()` adalah cara Laravel untuk memanggil URL lain (seperti `fetch` di JavaScript).

---

### Langkah 3 — Nuxt membangun System Prompt dan memanggil AI

Di `fuzan/server/api/ai.post.ts`, Nuxt menerima data dan mempersiapkan percakapan:

```typescript
// fuzan/server/api/ai.post.ts

export default defineEventHandler(async (event) => {
  const body = await readBody(event); // ← terima data dari Laravel

  const { prompt, history, konteks_dosen, konteks_prodi, konteks_mahasiswa } = body;

  // === BANGUN SYSTEM PROMPT ===
  // System prompt = "instruksi" untuk AI, berisi data kampus
  let systemMessage = `Kamu adalah FuzanAI, asisten akademik cerdas...
  Jangan pernah bilang data "hanya contoh" — semua data nyata dari database.`;

  // Masukkan data dosen ke dalam instruksi
  if (konteks_dosen.length > 0) {
    const listDosen = konteks_dosen
      .map(d => `• ${d.nama} | Prodi: ${d.prodi} | Jabatan: ${d.jabatan}`)
      .join("\n");
    systemMessage += `\n=== DATA DOSEN ===\n${listDosen}`;
  }

  // (Begitu pula untuk prodi dan mahasiswa...)

  // === SUSUN PESAN UNTUK AI ===
  const chatMessages = [
    { role: "system", content: systemMessage }, // ← instruksi + data kampus
    ...history,                                  // ← riwayat chat sebelumnya
    { role: "user", content: prompt }            // ← pertanyaan baru
  ];

  // === KIRIM KE OPENROUTER ===
  const openai = new OpenAI({
    baseURL: "https://openrouter.ai/api/v1",
    apiKey: process.env.OPENROUTER_API_KEY,
  });

  const completion = await openai.chat.completions.create({
    model: "google/gemini-2.0-flash-001",
    messages: chatMessages,
    temperature: 0.2, // ← semakin rendah = semakin konsisten/akurat
  });

  return { success: true, result: completion.choices[0].message.content };
});
```

> 💡 **System Prompt** adalah instruksi tersembunyi yang diberikan ke AI sebelum user berbicara. Di sinilah kita "mengajari" AI tentang data kampus.

### Ringkasan Alur AI

```
User tanya → Laravel ambil DB → Susun context → Kirim ke Nuxt
→ Nuxt bangun system prompt → Kirim ke Gemini → Jawaban
→ Nuxt return ke Laravel → Laravel return ke browser → Tampil di chat
```

---

## 🗃️ ERD (Entity Relationship Diagram)

```
┌──────────┐        ┌─────────────────┐        ┌──────────────┐
│  users   │        │    fakultas     │        │  mata_kuliahs│
├──────────┤        ├─────────────────┤        ├──────────────┤
│ id (PK)  │        │ id (PK)         │        │ id (PK)      │
│ name     │        │ name_fakultas   │        │ kode_mk      │
│ email    │        │ kode_fakultas   │        │ nama_mk      │
│ password │        └────────┬────────┘        │ sks          │
│ role     │                 │ 1               │ prodi_id(FK) │
└────┬─────┘                 │                 └──────┬───────┘
     │ 1                     │ memiliki               │
     │                       ▼ banyak                 │
     ├───────────┐   ┌───────────────────┐            │
     │           │   │  program_studis   │            │
     │           │   ├───────────────────┤            │
     │           │   │ id (PK)           │◄───────────┘
     │           │   │ fakultas_id (FK)  │
     │           │   │ nama_prodi        │
     │           │   │ jenjang (S1/S2..) │
     │           │   │ kode_prodi        │
     │           │   └──────┬────────────┘
     │           │          │ 1
     │           │          │ memiliki banyak
     │           │    ┌─────┴────┐    ┌──────────────┐
     │           │    ▼          ▼    │    kelas     │
     │    ┌──────┴───┐  ┌────────────┤├─────────────┤
     │    │  dosens  │  │ mahasiswas ││ id (PK)     │
     │    ├──────────┤  ├────────────┤│ dosen_id(FK)│
     │    │ id (PK)  │  │ id (PK)    ││ mk_id (FK)  │
     │    │ user_id  │◄─┤ user_id    ││ nama_kelas  │
     │    │ (FK)     │  │ (FK)       │└──────┬──────┘
     │    │ nidn     │  │ nim        │       │
     │    │ nama     │  │ nama       │       │ 1
     │    │ email    │  │ prodi_id   │       │
     │    │ prodi_id │  │ (FK)       │       ▼ banyak
     │    │ jabatan  │  │ angkatan   │  ┌──────────┐
     │    └──────────┘  │ status     │  │   krs    │
     │                  └─────┬──────┘  ├──────────┤
     └──────────────────────► │         │ id (PK)  │
                              │         │ mhs_id   │
                              └────────►│ kelas_id │
                                        │ semester │
                                        │ thn_ajr  │
                                        │ status   │
                                        └──────────┘
```

---

## 📊 Penjelasan Database

### Tabel `users`
Menyimpan akun login. Kolom `role` menentukan akses (`admin` atau `user`).

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | Primary Key | ID unik otomatis |
| name | string | Nama pengguna |
| email | string, unique | Email untuk login |
| password | string | Password ter-hash (bcrypt) |
| role | string | `admin` atau `user` |

### Tabel `fakultas`
Daftar fakultas yang ada di kampus.

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | Primary Key | - |
| name_fakultas | string | Nama fakultas |
| kode_fakultas | string | Kode singkat (ex: FT, FE) |

### Tabel `program_studis`
Setiap prodi terhubung ke satu fakultas.

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | Primary Key | - |
| fakultas_id | Foreign Key | → tabel `fakultas` |
| nama_prodi | string | Nama lengkap prodi |
| jenjang | string | S1, S2, D3, D4 |
| kode_prodi | string | Kode prodi |

### Tabel `dosens`
Data dosen terhubung ke user (login) dan program studi.

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | Primary Key | - |
| user_id | Foreign Key | → tabel `users` |
| nidn | string, unique | Nomor Induk Dosen |
| nama | string | Nama lengkap |
| email | string, unique | Email dosen |
| prodi_id | Foreign Key | → tabel `program_studis` |
| jabatan | string | Lektor, Professor, dll. |

### Tabel `mahasiswas`
Data mahasiswa terhubung ke user dan prodi.

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | Primary Key | - |
| user_id | Foreign Key | → tabel `users` |
| nim | string, unique | Nomor Induk Mahasiswa |
| nama | string | Nama lengkap |
| prodi_id | Foreign Key | → tabel `program_studis` |
| angkatan | integer | Tahun masuk (ex: 2023) |
| status | string | `aktif`, `cuti`, `lulus` |

### Tabel `krs`
Kartu Rencana Studi — mahasiswa memilih kelas di semester tertentu.

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | Primary Key | - |
| mahasiswa_id | Foreign Key | → tabel `mahasiswas` |
| kelas_id | Foreign Key | → tabel `kelas` |
| semester | integer | Semester ke berapa |
| tahun_ajaran | string | ex: `2024/2025` |
| status | enum | `pending`, `disetujui`, `ditolak` |

---

## ⚙️ Panduan Instalasi

### Prasyarat
Pastikan sudah terinstal:
- PHP 8.3+
- Composer
- Node.js 22+
- MySQL (via Laragon/XAMPP)

### 1. Clone & Install Laravel

```bash
# Masuk ke folder project
cd "test laravel/deshboard"

# Install dependency PHP
composer install

# Salin file environment
cp .env.example .env

# Generate app key
php artisan key:generate
```

### 2. Konfigurasi Database di `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kampusku_db   # ← nama database yang kamu buat
DB_USERNAME=root
DB_PASSWORD=               # ← password MySQL kamu
```

### 3. Jalankan Migrasi

```bash
# Buat semua tabel dari file migrations/
php artisan migrate
```

### 4. Setup Nuxt (fuzan)

```bash
# Masuk ke folder fuzan
cd fuzan

# Install dependency Node.js
npm install
```

### 5. Konfigurasi API Key di `fuzan/.env`

```env
OPENROUTER_API_KEY=sk-or-v1-xxxxxxxxxxxx   # ← API key dari openrouter.ai
APP_URL=http://localhost:3000
APP_NAME=FuzanAI
```

> 💡 Dapatkan API key gratis di [openrouter.ai](https://openrouter.ai)

---

## 🚀 Cara Menjalankan

Butuh **2 terminal** yang berjalan bersamaan:

### Terminal 1 — Jalankan Laravel
```bash
cd "test laravel/deshboard"
php artisan serve
# ✅ Berjalan di http://localhost:8000
```

### Terminal 2 — Jalankan Nuxt (AI Engine)
```bash
cd "test laravel/deshboard/fuzan"
npm run dev
# ✅ Berjalan di http://localhost:3000
```

### Akses Website
| URL | Halaman |
|---|---|
| `http://localhost:8000` | Landing page utama |
| `http://localhost:8000/ai` | Chat FuzanAI |
| `http://localhost:8000/login` | Login admin |
| `http://localhost:8000/admin/dashboard` | Dashboard admin |

---

## 📄 Penjelasan Kode Penting

### `routes/web.php` — Semua URL didefinisikan di sini

```php
// Halaman publik
Route::get('/', ...)->name('home');          // landing page
Route::get('/fakultas', ...)->name('fakultas.index');
Route::get('/program-studi', ...)->name('program-studi.index');
Route::get('/kontak', ...)->name('kontak');

// AI
Route::get('/ai', [AiController::class, 'index'])->name('ai.index');  // tampilkan halaman chat
Route::post('/ai/ask', [AiController::class, 'ask'])->name('ai.ask'); // proses pertanyaan

// Auth (hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', ...);
    Route::post('/login', ...);
    Route::get('/register', ...);
    Route::post('/register', ...);
});

// Admin (harus login DAN role = admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('dosen', DosenController::class);   // auto-generate 7 route CRUD
    Route::resource('mahasiswa', MahasiswaController::class);
    // dst...
});
```

> 💡 `Route::resource()` otomatis membuat 7 route: index, create, store, show, edit, update, destroy.

### `AiController.php` — Jembatan antara Laravel dan Nuxt

```php
// 1. Terima input dari browser
$prompt  = $request->input('prompt');   // pertanyaan user
$history = $request->input('history', []); // array riwayat chat

// 2. Query semua data yang dibutuhkan AI
$dosens = Dosen::with('programStudi')->get(); // dengan relasi

// 3. Format ulang data agar mudah dibaca AI
$konteksDosen = $dosens->map(fn($d) => [...])->toArray();

// 4. Kirim ke Nuxt (AI Engine)
$response = Http::timeout(60)->post('http://localhost:3000/api/ai', [
    'prompt'         => $prompt,
    'history'        => $history,
    'konteks_dosen'  => $konteksDosen,
    // ...
]);

// 5. Kembalikan jawaban AI ke browser
return response()->json(['success' => true, 'result' => $response->json()['result']]);
```

### `app/Models/Dosen.php` — Relasi Database

```php
class Dosen extends Model
{
    // Kolom yang boleh diisi (mass assignment protection)
    protected $fillable = ['nidn', 'user_id', 'nama', 'email', 'prodi_id', 'jabatan'];

    // Relasi: setiap Dosen PUNYA SATU User (untuk login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: setiap Dosen MASUK KE SATU Program Studi
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id');
        //                                             ↑ kolom foreign key
    }
}
```

---

## 🔐 Alur Autentikasi

```
User buka /login
    │
    ▼
Isi email & password → POST /login
    │
    ▼
AuthController::login()
    ├── Auth::attempt($credentials)   ← cek ke database
    │
    ├── ✅ Cocok → cek role
    │       ├── role = 'admin' → redirect /admin/dashboard
    │       └── role = 'user'  → redirect /
    │
    └── ❌ Tidak cocok → kembali ke form dengan pesan error
```

> 💡 Password TIDAK pernah disimpan dalam bentuk asli. Laravel menggunakan **bcrypt hash** — password asli tidak bisa dibalik.

---

## 🔧 Troubleshooting

### ❌ AI tidak bisa terkoneksi
**Gejala:** Error "Tidak dapat terhubung ke AI"

**Solusi:**
1. Pastikan Nuxt sudah berjalan: `npm run dev` di folder `fuzan/`
2. Pastikan berjalan di port 3000
3. Cek apakah `fuzan/.env` sudah berisi `OPENROUTER_API_KEY`

---

### ❌ AI menjawab "data kampus kosong"
**Gejala:** AI bilang tidak ada data dosen/prodi

**Solusi:**
1. Pastikan database sudah diisi data melalui Admin Dashboard
2. Cek di `storage/logs/laravel.log` untuk melihat log debug:
   ```
   [info] AI Request dikirim ke Nuxt {"jumlah_dosen":5,"jumlah_prodi":3}
   ```
3. Jika `jumlah_dosen: 0` → tabel `dosens` kosong, isi data dulu

---

### ❌ Halaman admin tidak bisa diakses
**Gejala:** Redirect ke login atau 403

**Solusi:**
1. Pastikan sudah login
2. Pastikan user punya `role = 'admin'` di tabel `users`
3. Untuk mengubah role manual: jalankan di `php artisan tinker`:
   ```php
   User::where('email', 'kamu@email.com')->update(['role' => 'admin']);
   ```

---

### ❌ `php artisan migrate` error
**Solusi:**
1. Pastikan database sudah dibuat di MySQL
2. Pastikan konfigurasi `.env` benar (host, database, username, password)

---

## 📝 Catatan untuk Pengembangan Selanjutnya

- [ ] Tambah **streaming response** agar jawaban AI muncul kata per kata
- [ ] Simpan riwayat chat ke database agar history tidak hilang saat refresh
- [ ] Tambah context **KRS dan Kelas** ke AI agar bisa menjawab pertanyaan jadwal
- [ ] Implementasi **email** untuk form kontak menggunakan Laravel Mail
- [ ] Tambah **Google Maps embed** sungguhan di halaman kontak

---

## 👨‍💻 Dibuat Oleh

**Fauzan** — Mahasiswa yang sedang belajar Laravel, Nuxt.js, dan Integrasi AI

> *"Proyek ini dibuat untuk membuktikan bahwa Laravel dan AI bisa berjalan beriringan dengan indah."*

---

<p align="center">
  Powered by <strong>Laravel</strong> × <strong>Nuxt.js</strong> × <strong>OpenRouter AI</strong>
</p>
