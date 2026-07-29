# DESAIN.md — Panduan Desain Dashboard

> Dokumen ini menjadi sumber acuan visual untuk seluruh halaman dashboard agar warna, tipografi, komponen, tata letak, dan perilaku visual tetap konsisten.

## 1. Ruang Lingkup

Panduan ini hanya mengatur aspek desain antarmuka, meliputi:

- identitas visual;
- warna dan design token;
- tipografi;
- jarak dan grid;
- struktur halaman dashboard;
- gaya komponen;
- state visual;
- responsivitas;
- aksesibilitas visual;
- aturan konsistensi.

Dokumen ini tidak membahas arsitektur aplikasi, database, API, autentikasi, otorisasi, business logic, struktur folder, framework, atau implementasi kode.

---

## 2. Arah Visual

Dashboard menggunakan gaya **enterprise operational dashboard** yang bersih, ringan, dan padat informasi. Karakter visualnya mengikuti referensi gambar:

- sidebar berwarna navy gelap;
- aksen cyan untuk navigasi aktif dan tindakan utama;
- area kerja menggunakan latar biru-abu yang sangat terang;
- kartu dan tabel berwarna putih;
- garis pemisah tipis;
- sudut komponen kecil, bukan bentuk pill berlebihan;
- bayangan sangat lembut;
- kepadatan informasi relatif tinggi, tetapi tetap mudah dipindai;
- warna status hanya digunakan secara terbatas dan konsisten.

### Prinsip utama

1. **Data lebih dominan daripada dekorasi.**
2. **Satu warna aksen utama pada satu layar.**
3. **Hierarki dibentuk melalui ukuran, ketebalan, kontras, dan jarak.**
4. **Komponen serupa harus memiliki ukuran dan perilaku visual yang sama.**
5. **Warna tidak boleh menjadi satu-satunya penanda status.**
6. **Tampilan tetap profesional, ringan, dan tidak terasa ramai.**

---

## 3. Design Tokens

Semua keputusan visual harus mengacu pada token berikut. Hindari menambahkan warna, radius, ukuran, atau shadow baru tanpa memperbarui dokumen ini.

## 3.1 Warna Brand

| Token | Nilai | Penggunaan |
|---|---:|---|
| `brand.navy.900` | `#293B5F` | sidebar utama, area navigasi gelap |
| `brand.navy.800` | `#344C70` | hover sidebar, elemen navy sekunder |
| `brand.cyan.700` | `#007D9E` | tombol utama dengan teks putih |
| `brand.cyan.500` | `#00B4E4` | aksen visual, indikator aktif, ikon dekoratif |
| `brand.cyan.100` | `#DFF5FA` | latar aktif atau selected state |
| `brand.cyan.050` | `#EFFBFD` | hover sangat ringan |

### Aturan penggunaan warna brand

- Gunakan `brand.cyan.700` untuk tombol utama agar teks putih tetap terbaca.
- Gunakan `brand.cyan.500` untuk garis aktif, ikon, indikator, atau elemen nonteks.
- Jangan menggunakan cyan terang sebagai warna teks kecil di atas putih.
- Navy menjadi identitas area navigasi, bukan warna latar seluruh halaman.

## 3.2 Warna Netral

| Token | Nilai | Penggunaan |
|---|---:|---|
| `neutral.000` | `#FFFFFF` | surface, kartu, tabel, topbar |
| `neutral.025` | `#F9FBFC` | latar input read-only atau area sangat ringan |
| `neutral.050` | `#F2F7F9` | latar konten dashboard |
| `neutral.100` | `#E7E9F0` | canvas luar atau latar halaman |
| `neutral.200` | `#D9E2E8` | border default |
| `neutral.300` | `#C2CED7` | border kuat, divider aktif |
| `neutral.500` | `#687584` | teks sekunder |
| `neutral.700` | `#3F4C5E` | teks body |
| `neutral.900` | `#26354A` | heading dan teks utama |

## 3.3 Warna Status

| Status | Teks/Ikon | Latar lembut | Border |
|---|---:|---:|---:|
| Success | `#137A5B` | `#E7F7F1` | `#B9E8D8` |
| Danger | `#C23850` | `#FDECEF` | `#F4C4CD` |
| Warning | `#8A5A00` | `#FFF5D9` | `#F2D99A` |
| Info | `#006B86` | `#E5F6FA` | `#B7E5EF` |
| Disabled | `#687584` | `#EEF1F4` | `#D8DEE5` |

### Aturan status

- Status harus selalu disertai label teks, bukan hanya warna.
- Jangan memberi warna penuh pada seluruh baris tabel.
- Gunakan status berbentuk teks berikon atau badge lembut.
- Gunakan istilah status yang konsisten, misalnya `Enabled`, `Disabled`, `Pending`, dan `Error`.

## 3.4 Shadow

| Token | Nilai | Penggunaan |
|---|---|---|
| `shadow.none` | none | tabel dan panel yang sudah memiliki border |
| `shadow.soft` | `0 2px 8px rgba(26, 50, 75, 0.08)` | kartu mengambang ringan |
| `shadow.overlay` | `0 8px 24px rgba(26, 50, 75, 0.16)` | dropdown, popover, modal |

Bayangan tidak boleh menjadi elemen dominan. Gunakan border tipis sebagai pemisah utama.

## 3.5 Radius

| Token | Nilai | Penggunaan |
|---|---:|---|
| `radius.0` | `0px` | divider dan elemen struktural tertentu |
| `radius.2` | `2px` | badge kecil, indikator |
| `radius.4` | `4px` | tombol, input, dropdown, tabel |
| `radius.6` | `6px` | card dan popover |
| `radius.8` | `8px` | modal besar atau empty state |

Gunakan radius kecil agar dashboard mempertahankan karakter enterprise. Hindari radius 16–24 px dan pill pada komponen umum.

---

## 4. Tipografi

### Font utama

Gunakan **Inter** untuk seluruh antarmuka dashboard.

Fallback:

`Inter, Arial, Helvetica, sans-serif`

### Bobot font

- 400 — regular body text;
- 500 — label, tombol, navigasi, table header;
- 600 — judul halaman dan heading section;
- 700 — hanya untuk angka penting atau penekanan khusus.

### Skala tipografi

| Style | Ukuran / Line-height | Weight | Penggunaan |
|---|---:|---:|---|
| Display | `28 / 36 px` | 600 | judul dashboard utama, jarang digunakan |
| Heading 1 | `24 / 32 px` | 600 | judul halaman |
| Heading 2 | `18 / 26 px` | 600 | judul panel atau section |
| Heading 3 | `16 / 24 px` | 600 | subbagian |
| Body | `14 / 20 px` | 400 | teks utama |
| Body strong | `14 / 20 px` | 500 | nilai atau label penting |
| Table | `12 / 18 px` | 400 | isi tabel padat |
| Table header | `11 / 16 px` | 500 | header kolom |
| Caption | `11 / 16 px` | 400 | metadata, breadcrumb, bantuan |
| Button | `13 / 18 px` | 500 | label tombol |

### Aturan tipografi

- Gunakan sentence case untuk tombol, filter, dan label.
- Gunakan title case hanya untuk judul halaman.
- Hindari penggunaan huruf kapital penuh, kecuali kode pendek atau singkatan.
- ID, serial number, dan angka tabel menggunakan tabular numerals agar kolom lebih mudah dipindai.
- Teks body tidak boleh lebih kecil dari 12 px.

---

## 5. Sistem Jarak dan Grid

Gunakan grid dasar **4 px**, dengan skala utama berbasis 8 px.

| Token | Nilai |
|---|---:|
| `space.1` | `4px` |
| `space.2` | `8px` |
| `space.3` | `12px` |
| `space.4` | `16px` |
| `space.5` | `20px` |
| `space.6` | `24px` |
| `space.8` | `32px` |
| `space.10` | `40px` |
| `space.12` | `48px` |

### Aturan jarak

- Jarak internal tombol dan input: 8–12 px.
- Jarak antar-komponen dalam satu grup: 8 px.
- Jarak antar-grup: 16 px.
- Jarak antar-section: 24–32 px.
- Padding halaman desktop: 24 px.
- Padding card utama: 16–20 px.
- Gunakan whitespace untuk membentuk grup, bukan menambahkan terlalu banyak garis.

---

## 6. Struktur Dashboard

## 6.1 App Shell

Struktur halaman utama:

```text
┌──────────────────────────────────────────────────────────┐
│ Topbar                                                   │
├──────────┬───────────────────────────────────────────────┤
│ Sidebar  │ Breadcrumb                                    │
│          │ Page title + page actions                      │
│          │ ┌──────────────────────────┬────────────────┐ │
│          │ │ Main content / data table│ Filter panel   │ │
│          │ └──────────────────────────┴────────────────┘ │
└──────────┴───────────────────────────────────────────────┘
```

### Ukuran utama

| Elemen | Ukuran |
|---|---:|
| Topbar | `56px` tinggi |
| Sidebar collapsed | `72px` lebar |
| Sidebar expanded | `224px` lebar |
| Content padding | `24px` |
| Filter panel | `264–288px` |
| Toolbar | minimum `48px` tinggi |
| Table row compact | `40–44px` |
| Table row comfortable | `48–52px` |

## 6.2 Topbar

Karakter:

- latar putih;
- border bawah `1px solid neutral.200`;
- logo di kiri;
- search global setelah logo;
- notifikasi dan profil di kanan;
- tinggi konsisten 56 px;
- tidak menggunakan shadow berat.

### Search global

- tinggi 36 px;
- lebar ideal 240–320 px;
- ikon pencarian 16 px;
- latar putih atau `neutral.025`;
- border transparan saat default;
- border cyan saat fokus.

## 6.3 Sidebar

Karakter:

- background `brand.navy.900`;
- ikon berwarna putih dengan opacity 70%;
- label berwarna putih dengan opacity 80%;
- item aktif menggunakan indikator cyan 3 px di sisi kiri;
- item aktif boleh menggunakan background `brand.navy.800`;
- hover tidak boleh lebih terang daripada active state.

### Item navigasi

| Properti | Nilai |
|---|---:|
| Tinggi item | `56–64px` |
| Ikon | `18–20px` |
| Label | `11–12px`, weight 500 |
| Jarak ikon–label | `6px` |
| Indikator aktif | `3px` |

## 6.4 Area Konten

- background `neutral.050`;
- breadcrumb berada di atas judul;
- judul halaman berada di kiri;
- tombol tindakan halaman berada di kanan;
- tabel atau panel utama menggunakan surface putih;
- konten tidak menempel langsung ke sidebar atau topbar.

---

## 7. Komponen Inti

## 7.1 Breadcrumb

- ukuran 11–12 px;
- warna `neutral.500`;
- item aktif menggunakan `neutral.700`;
- separator menggunakan chevron kecil;
- maksimal 3 tingkat pada tampilan desktop.

Contoh:

`Admin / Manage units`

## 7.2 Page Header

Struktur:

- breadcrumb;
- judul halaman;
- deskripsi opsional satu baris;
- page action di sisi kanan.

Judul menggunakan `Heading 1`. Jangan meletakkan lebih dari satu tombol utama dalam page header.

## 7.3 Card dan Panel

| Properti | Nilai |
|---|---|
| Background | `neutral.000` |
| Border | `1px solid neutral.200` |
| Radius | `radius.4` atau `radius.6` |
| Shadow | none atau `shadow.soft` |
| Padding | `16–20px` |

Gunakan card untuk mengelompokkan informasi. Jangan membuat card di dalam card jika border dan hierarchy tidak benar-benar diperlukan.

## 7.4 Button

### Primary button

- background `brand.cyan.700`;
- teks putih;
- ikon putih;
- tinggi 36 px;
- padding horizontal 12–16 px;
- radius 4 px;
- label 13 px, weight 500.

### Secondary button

- background putih;
- border `neutral.300`;
- teks `neutral.700`;
- hover menggunakan `neutral.050`.

### Ghost button

- background transparan;
- tanpa border;
- teks atau ikon `neutral.500`;
- hover menggunakan `neutral.050`.

### Danger button

- hanya digunakan untuk tindakan destruktif;
- background `#C23850`;
- teks putih;
- jangan digunakan sebagai default action.

### Aturan button

- satu area toolbar hanya memiliki satu primary button;
- ikon berada di kiri label untuk tindakan umum;
- tombol hanya ikon wajib memiliki tooltip;
- minimum target interaksi 36 × 36 px;
- urutan: primary, secondary, kemudian ghost.

## 7.5 Icon Button

| Properti | Nilai |
|---|---:|
| Container | `32–36px` |
| Ikon | `16–18px` |
| Radius | `4px` |
| Gap antartombol | `4px` |

Gunakan gaya ikon outline dengan ketebalan stroke yang konsisten. Jangan mencampur ikon filled dan outline dalam satu toolbar.

## 7.6 Input, Select, dan Search

| Properti | Nilai |
|---|---:|
| Tinggi compact | `36px` |
| Tinggi comfortable | `40px` |
| Padding horizontal | `10–12px` |
| Border | `neutral.300` |
| Radius | `4px` |
| Label | `11–12px`, weight 500 |
| Helper text | `11px` |

### State input

- default: border `neutral.300`;
- hover: border `neutral.500`;
- focus: border `brand.cyan.700` dengan focus ring;
- error: border `danger` dan pesan error;
- disabled: latar `neutral.050`, teks `neutral.500`.

Placeholder tidak boleh menggantikan label.

## 7.7 Data Table

Data table merupakan komponen utama dan harus diprioritaskan untuk keterbacaan serta kecepatan pemindaian.

### Struktur

- table toolbar;
- header row;
- data rows;
- actions column;
- pagination;
- filter panel opsional.

### Spesifikasi visual

| Elemen | Spesifikasi |
|---|---|
| Header background | putih atau `neutral.025` |
| Header text | `neutral.500`, 11 px, weight 500 |
| Body text | `neutral.700`, 12 px |
| Row divider | `1px solid neutral.200` |
| Hover row | `brand.cyan.050` |
| Selected row | `brand.cyan.100` |
| Row height | 40–44 px compact |
| Cell padding | 8–12 px horizontal |
| Empty cell | em dash `—`, bukan nilai palsu |

### Alignment

- teks: rata kiri;
- angka: rata kanan;
- status: rata kiri;
- actions: rata kanan;
- checkbox: rata tengah;
- tanggal konsisten dalam satu format.

### Kolom tindakan

Pola utama:

- tampilkan maksimal dua tindakan paling sering digunakan;
- tindakan lain dimasukkan ke menu overflow;
- tindakan destruktif diletakkan paling bawah dan dipisahkan divider;
- semua icon action memiliki tooltip;
- hindari menampilkan lebih dari empat ikon sekaligus.

### Header tabel

- nama kolom singkat;
- sortable column menggunakan ikon sort;
- ikon sort hanya tampak kuat pada kolom aktif;
- header tidak menggunakan warna cyan penuh.

### Baris tabel

- tidak menggunakan zebra striping kecuali tabel sangat panjang;
- hover hanya memberi perubahan background ringan;
- baris disabled tetap terbaca dan memiliki label status;
- jangan memotong ID penting tanpa tooltip atau detail view.

## 7.8 Status Badge

| Properti | Nilai |
|---|---:|
| Tinggi | `22–24px` |
| Padding horizontal | `6–8px` |
| Radius | `2–4px` |
| Font | `11px`, weight 500 |

Gunakan badge lembut. Hindari badge berwarna solid terang untuk tabel padat.

Contoh:

- Enabled — success;
- Disabled — danger;
- Pending — warning;
- Processing — info.

## 7.9 Filter Toggle

Tombol filter ditempatkan di kanan toolbar tabel.

State:

- closed: ikon filter + label `Show filters`;
- open: ikon filter + label `Hide filters`;
- active filter: tampilkan jumlah filter, misalnya `Filters · 3`;
- tombol tetap bergaya secondary, bukan primary.

## 7.10 Filter Panel

Filter panel muncul di kanan tabel pada desktop.

| Properti | Nilai |
|---|---:|
| Lebar | `264–288px` |
| Background | `neutral.000` |
| Border kiri | `neutral.200` |
| Padding | `16px` |
| Gap field | `12px` |

Struktur:

1. judul `Filters`;
2. daftar field;
3. tombol `Apply filters`;
4. tombol `Reset` sebagai ghost action.

Untuk filter yang langsung diterapkan, tetap tampilkan `Clear all` dan indikator active filter.

## 7.11 Dropdown dan Action Menu

- lebar minimum 180 px;
- background putih;
- radius 6 px;
- `shadow.overlay`;
- item tinggi 36–40 px;
- ikon 16 px;
- item destruktif menggunakan warna danger;
- menu tidak boleh keluar dari viewport.

## 7.12 Pagination

- ditempatkan di bawah tabel;
- posisi tengah atau kanan, konsisten pada semua halaman;
- button 32 × 32 px;
- halaman aktif menggunakan background cyan dan teks putih;
- previous/next menggunakan ikon chevron;
- disabled state tetap terlihat tetapi tidak dominan.

## 7.13 Tooltip

- digunakan untuk icon-only button, istilah teknis, dan teks terpotong;
- background `neutral.900`;
- teks putih 11 px;
- radius 4 px;
- maksimum dua baris.

## 7.14 Modal

- radius 8 px;
- lebar 480–640 px untuk form umum;
- header, body, dan footer dipisahkan secara jelas;
- primary action di kanan;
- tindakan destruktif membutuhkan konfirmasi eksplisit;
- overlay menggunakan hitam 40%.

## 7.15 Toast dan Alert

- toast berada di kanan atas;
- lebar 320–400 px;
- menggunakan ikon + judul + deskripsi;
- warna status hanya sebagai aksen kiri atau latar lembut;
- tidak menutupi tindakan utama.

## 7.16 Empty State

Terdiri atas:

- ikon ilustratif sederhana;
- judul singkat;
- penjelasan satu hingga dua baris;
- satu tindakan utama jika relevan.

Jangan menggunakan ilustrasi berwarna ramai pada dashboard enterprise.

## 7.17 Loading State

- gunakan skeleton untuk tabel dan card;
- pertahankan tinggi layout agar tidak terjadi pergeseran besar;
- gunakan spinner hanya untuk aksi lokal atau proses singkat;
- loading table menampilkan 5–8 skeleton rows.

---

## 8. State Visual Global

Setiap komponen interaktif wajib memiliki state berikut:

| State | Arahan visual |
|---|---|
| Default | tampilan normal dengan kontras yang cukup |
| Hover | perubahan background atau border yang ringan |
| Active/Pressed | warna sedikit lebih gelap dan posisi tetap |
| Focus | focus ring terlihat jelas |
| Selected | background cyan sangat muda dan indikator visual |
| Disabled | saturasi berkurang, tetapi label tetap terbaca |
| Loading | skeleton atau spinner sesuai konteks |
| Error | ikon, warna, dan pesan teks |

### Focus ring

Gunakan:

- outline 2 px `brand.cyan.700`;
- offset 2 px;
- tidak dihilangkan pada navigasi keyboard.

---

## 9. Responsivitas

## 9.1 Desktop Besar — ≥ 1440 px

- sidebar dapat expanded atau collapsed;
- filter panel tampil di samping tabel;
- semua kolom prioritas tinggi terlihat;
- toolbar satu baris.

## 9.2 Desktop — 1200–1439 px

- sidebar default collapsed;
- filter panel tetap tersedia;
- kolom prioritas rendah dapat disembunyikan;
- table dapat horizontal scroll jika diperlukan.

## 9.3 Tablet — 768–1199 px

- sidebar menjadi drawer;
- filter panel menjadi slide-over;
- toolbar dapat menjadi dua baris;
- action icons dipindahkan ke overflow menu;
- table menggunakan horizontal scroll dengan kolom pertama dapat sticky.

## 9.4 Mobile — < 768 px

- topbar lebih sederhana;
- search global masuk ke overlay atau halaman pencarian;
- tabel diubah menjadi list card atau summary row;
- tindakan per item masuk ke menu overflow;
- filter menjadi full-screen sheet;
- tombol utama dapat memenuhi lebar container.

### Prioritas kolom responsif

1. identitas utama;
2. status;
3. informasi operasional utama;
4. lokasi atau kategori;
5. metadata sekunder;
6. actions.

---

## 10. Aksesibilitas Visual

- Teks reguler harus memiliki kontras minimum 4.5:1 terhadap background.
- Teks besar dan elemen grafis penting menggunakan kontras minimum 3:1.
- Status tidak boleh dibedakan hanya melalui warna.
- Semua icon-only button wajib memiliki tooltip dan accessible label.
- Focus state wajib terlihat.
- Ukuran target interaksi ideal minimal 36 × 36 px untuk dashboard desktop.
- Teks tidak dimasukkan sebagai gambar.
- Hindari placeholder sebagai satu-satunya label input.
- Error harus menyebutkan masalah secara eksplisit.
- Tabel harus memiliki header yang jelas dan urutan fokus yang logis.

---

## 11. Ikonografi

Gunakan satu keluarga ikon outline secara konsisten, misalnya **Lucide** atau keluarga ikon outline sejenis.

### Spesifikasi

- ukuran default 16 px;
- sidebar 18–20 px;
- stroke 1.75–2 px;
- ujung garis konsisten;
- filled icon hanya untuk status tertentu atau penanda aktif;
- jangan menggabungkan lebih dari satu gaya ikon dalam satu halaman.

### Ikon yang direkomendasikan

- Home — dashboard/admin;
- Bar chart — reporting;
- Plus circle — add unit;
- Filter — filter panel;
- Pencil — edit;
- Power — enable/disable;
- Map pin — location;
- More horizontal — overflow actions;
- Chevron — dropdown dan pagination;
- Search — pencarian.

---

## 12. Pola Halaman “Manage Units”

Halaman pengelolaan unit mengikuti urutan visual berikut:

1. Topbar global.
2. Sidebar navigation.
3. Breadcrumb `Admin / Manage units`.
4. Judul halaman `Manage units`.
5. Card utama berisi:
   - label section `Units`;
   - tombol `Add unit`;
   - tombol show/hide filters;
   - tabel unit;
   - filter panel opsional;
   - pagination.

### Urutan kolom yang disarankan

1. Unit ID;
2. Unit make;
3. Unit serial number;
4. Unit type;
5. Location;
6. Vehicle registration;
7. Status;
8. Actions.

### Pola actions yang dipilih

Gunakan pola campuran yang konsisten:

- satu hingga dua icon actions untuk tindakan yang paling sering dilakukan;
- satu overflow menu untuk tindakan tambahan;
- tindakan berisiko tinggi tidak ditampilkan sebagai ikon tanpa label;
- menu action tidak berubah posisi antarbari.

---

## 13. Aturan Konsistensi

### Wajib dilakukan

- gunakan token warna dan spacing yang telah ditentukan;
- gunakan satu primary action pada satu toolbar;
- gunakan tinggi komponen yang konsisten;
- gunakan label yang singkat;
- sejajarkan angka ke kanan;
- gunakan tooltip untuk ikon;
- pertahankan posisi actions column;
- tampilkan filter aktif secara jelas;
- gunakan pagination yang sama pada semua tabel.

### Dilarang

- menggunakan gradient;
- menggunakan shadow berat;
- menggunakan terlalu banyak warna aksen;
- menggunakan radius besar pada seluruh komponen;
- menampilkan lima atau lebih action icons dalam satu baris;
- membuat setiap section menjadi card terpisah;
- menggunakan warna status sebagai background penuh satu baris;
- menghilangkan focus outline;
- menggunakan ukuran font di bawah 11 px;
- mencampur gaya ikon;
- mengubah pola toolbar pada halaman yang sejenis.

---

## 14. Checklist Review Desain

Sebelum desain dianggap selesai, periksa:

- [ ] Warna berasal dari design tokens.
- [ ] Sidebar, topbar, dan content area mengikuti app shell.
- [ ] Hanya ada satu primary button dalam satu area tindakan.
- [ ] Semua input memiliki label.
- [ ] Semua icon button memiliki tooltip.
- [ ] Tabel dapat dipindai dengan cepat.
- [ ] Alignment kolom konsisten.
- [ ] Status memiliki teks, bukan hanya warna.
- [ ] Focus state terlihat.
- [ ] Kontras teks memenuhi standar.
- [ ] Empty, loading, error, dan disabled state tersedia.
- [ ] Filter aktif dapat diketahui dan dihapus.
- [ ] Tindakan destruktif diberi pemisahan dan konfirmasi.
- [ ] Desain tablet dan mobile telah didefinisikan.
- [ ] Tidak ada gradient, shadow berat, atau radius berlebihan.

---

## 15. Referensi Praktik Desain

Panduan ini disusun dengan mengadaptasi prinsip dari:

- referensi visual dashboard yang diberikan;
- WCAG 2.2 untuk kontras, focus state, dan penggunaan warna;
- Material Design 3 untuk density, spacing, interaction state, dan komponen;
- IBM Carbon Design System untuk pola data table;
- Atlassian Design System untuk penggunaan design tokens dan fondasi visual.

---

## 16. Ringkasan Identitas Visual

**Kepribadian:** profesional, operasional, terstruktur, dan ringan.  
**Warna utama:** navy gelap dan cyan.  
**Surface:** putih di atas background biru-abu muda.  
**Tipografi:** Inter dengan skala kompak.  
**Radius:** kecil, 2–6 px.  
**Shadow:** lembut dan jarang digunakan.  
**Kepadatan:** compact untuk tabel, comfortable untuk form.  
**Fokus utama:** keterbacaan data, konsistensi tindakan, dan navigasi yang jelas.
