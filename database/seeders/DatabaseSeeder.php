<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Faq;
use App\Models\InformasiKampus;
use App\Models\KalenderAkademik;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            "name" => "Admin Utama", "email" => "admin@gmail.com",
            "password" => Hash::make("password"), "role" => "admin",
        ]);

        $ft = Fakultas::create(["name_fakultas" => "Fakultas Teknik dan Informatika", "kode_fakultas" => "FTI"]);
        $feb = Fakultas::create(["name_fakultas" => "Fakultas Ekonomi dan Bisnis", "kode_fakultas" => "FEB"]);
        $fisip = Fakultas::create(["name_fakultas" => "Fakultas Ilmu Sosial dan Ilmu Politik", "kode_fakultas" => "FISIP"]);

        $ti = ProgramStudi::create(["fakultas_id" => $ft->id, "nama_prodi" => "Teknik Informatika", "jenjang" => "S1", "kode_prodi" => "TI"]);
        $si = ProgramStudi::create(["fakultas_id" => $ft->id, "nama_prodi" => "Sistem Informasi", "jenjang" => "S1", "kode_prodi" => "SI"]);
        $ak = ProgramStudi::create(["fakultas_id" => $feb->id, "nama_prodi" => "Akuntansi", "jenjang" => "S1", "kode_prodi" => "AK"]);
        $mn = ProgramStudi::create(["fakultas_id" => $feb->id, "nama_prodi" => "Manajemen", "jenjang" => "S1", "kode_prodi" => "MN"]);
        $ilmuKom = ProgramStudi::create(["fakultas_id" => $fisip->id, "nama_prodi" => "Ilmu Komunikasi", "jenjang" => "S1", "kode_prodi" => "IK"]);
        $adNeg = ProgramStudi::create(["fakultas_id" => $fisip->id, "nama_prodi" => "Administrasi Negara", "jenjang" => "S1", "kode_prodi" => "AN"]);

        // Dosen
        Dosen::insert([
            ["nama" => "Prof. Dr. H. Ahmad Zaki, M.Si", "nidn" => "0010010001", "jabatan" => "Rektor", "email" => "rektor@adzkia.ac.id", "prodi_id" => $ti->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Dr. Eng. Rina Afriani, S.T., M.Kom", "nidn" => "0010020001", "jabatan" => "Dekan FTI", "email" => "dekan.fti@adzkia.ac.id", "prodi_id" => $ti->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Dr. Hendra Saputra, S.E., M.M", "nidn" => "0010030001", "jabatan" => "Dekan FEB", "email" => "dekan.feb@adzkia.ac.id", "prodi_id" => $ak->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Dr. Nani Kusumawati, S.Sos., M.I.Kom", "nidn" => "0010040001", "jabatan" => "Dekan FISIP", "email" => "dekan.fisip@adzkia.ac.id", "prodi_id" => $ilmuKom->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Dr. Budi Santoso, S.T., M.Kom", "nidn" => "0011010001", "jabatan" => "Kaprodi Teknik Informatika", "email" => "budi@adzkia.ac.id", "prodi_id" => $ti->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Aulia Rahman, S.T., M.T", "nidn" => "0011010002", "jabatan" => "Lektor", "email" => "aulia@adzkia.ac.id", "prodi_id" => $ti->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Fitriani, S.Kom., M.Kom", "nidn" => "0011010003", "jabatan" => "Lektor", "email" => "fitriani@adzkia.ac.id", "prodi_id" => $ti->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Ir. Hendra Gunawan, M.T", "nidn" => "0011010004", "jabatan" => "Lektor Kepala", "email" => "hendra@adzkia.ac.id", "prodi_id" => $ti->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Dr. Maya Sari, S.Kom., M.T", "nidn" => "0011020001", "jabatan" => "Kaprodi Sistem Informasi", "email" => "maya@adzkia.ac.id", "prodi_id" => $si->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Rizki Pratama, S.Kom., M.Kom", "nidn" => "0011020002", "jabatan" => "Lektor", "email" => "rizki@adzkia.ac.id", "prodi_id" => $si->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Dr. Elvi Yanti, S.E., M.Si., Ak", "nidn" => "0011030001", "jabatan" => "Kaprodi Akuntansi", "email" => "elvi@adzkia.ac.id", "prodi_id" => $ak->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "M. Fauzan, S.E., M.M", "nidn" => "0011030002", "jabatan" => "Lektor", "email" => "fauzan@adzkia.ac.id", "prodi_id" => $ak->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Dr. Rizal Syahputra, S.E., M.M", "nidn" => "0011040001", "jabatan" => "Kaprodi Manajemen", "email" => "rizal@adzkia.ac.id", "prodi_id" => $mn->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Dr. Sarah Permata, S.Sos., M.I.Kom", "nidn" => "0011050001", "jabatan" => "Kaprodi Ilmu Komunikasi", "email" => "sarah@adzkia.ac.id", "prodi_id" => $ilmuKom->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Doni Setiawan, S.I.Kom., M.M", "nidn" => "0011050002", "jabatan" => "Lektor", "email" => "doni@adzkia.ac.id", "prodi_id" => $ilmuKom->id, "created_at" => now(), "updated_at" => now()],
            ["nama" => "Dr. Winda Susanti, S.Sos., M.A.P", "nidn" => "0011060001", "jabatan" => "Kaprodi Administrasi Negara", "email" => "winda@adzkia.ac.id", "prodi_id" => $adNeg->id, "created_at" => now(), "updated_at" => now()],
        ]);

        // Mata Kuliah
        $semuaMk = [
            ["kode" => "TI101", "nama" => "Pemrograman Dasar", "sks" => 3, "semester" => 1, "prodi" => $ti->id],
            ["kode" => "TI102", "nama" => "Matematika Diskrit", "sks" => 3, "semester" => 1, "prodi" => $ti->id],
            ["kode" => "TI103", "nama" => "Pengantar Teknologi Informasi", "sks" => 2, "semester" => 1, "prodi" => $ti->id],
            ["kode" => "TI104", "nama" => "Aljabar Linear", "sks" => 3, "semester" => 1, "prodi" => $ti->id],
            ["kode" => "TI105", "nama" => "Logika Informatika", "sks" => 2, "semester" => 1, "prodi" => $ti->id],
            ["kode" => "TI201", "nama" => "Pemrograman Web", "sks" => 3, "semester" => 2, "prodi" => $ti->id],
            ["kode" => "TI202", "nama" => "Basis Data", "sks" => 4, "semester" => 2, "prodi" => $ti->id],
            ["kode" => "TI203", "nama" => "Struktur Data", "sks" => 3, "semester" => 2, "prodi" => $ti->id],
            ["kode" => "TI204", "nama" => "Sistem Operasi", "sks" => 3, "semester" => 2, "prodi" => $ti->id],
            ["kode" => "TI205", "nama" => "Jaringan Komputer", "sks" => 3, "semester" => 3, "prodi" => $ti->id],
            ["kode" => "TI206", "nama" => "Pemrograman Berorientasi Objek", "sks" => 3, "semester" => 3, "prodi" => $ti->id],
            ["kode" => "TI301", "nama" => "Rekayasa Perangkat Lunak", "sks" => 3, "semester" => 4, "prodi" => $ti->id],
            ["kode" => "TI302", "nama" => "Kecerdasan Buatan", "sks" => 3, "semester" => 5, "prodi" => $ti->id],
            ["kode" => "TI303", "nama" => "Sistem Informasi Manajemen", "sks" => 3, "semester" => 4, "prodi" => $ti->id],
            ["kode" => "SI101", "nama" => "Pengantar Sistem Informasi", "sks" => 3, "semester" => 1, "prodi" => $si->id],
            ["kode" => "SI102", "nama" => "Pemrograman Visual", "sks" => 3, "semester" => 1, "prodi" => $si->id],
            ["kode" => "SI103", "nama" => "Analisis Proses Bisnis", "sks" => 3, "semester" => 2, "prodi" => $si->id],
            ["kode" => "SI201", "nama" => "Manajemen Basis Data", "sks" => 3, "semester" => 2, "prodi" => $si->id],
            ["kode" => "SI202", "nama" => "Sistem Pendukung Keputusan", "sks" => 3, "semester" => 4, "prodi" => $si->id],
            ["kode" => "AK101", "nama" => "Pengantar Akuntansi", "sks" => 3, "semester" => 1, "prodi" => $ak->id],
            ["kode" => "AK102", "nama" => "Ekonomi Mikro", "sks" => 3, "semester" => 1, "prodi" => $ak->id],
            ["kode" => "AK103", "nama" => "Akuntansi Keuangan", "sks" => 3, "semester" => 2, "prodi" => $ak->id],
            ["kode" => "AK201", "nama" => "Audit", "sks" => 3, "semester" => 4, "prodi" => $ak->id],
            ["kode" => "AK202", "nama" => "Perpajakan", "sks" => 3, "semester" => 5, "prodi" => $ak->id],
            ["kode" => "MN101", "nama" => "Pengantar Manajemen", "sks" => 3, "semester" => 1, "prodi" => $mn->id],
            ["kode" => "MN102", "nama" => "Ekonomi Manajerial", "sks" => 3, "semester" => 2, "prodi" => $mn->id],
            ["kode" => "MN103", "nama" => "Manajemen SDM", "sks" => 3, "semester" => 3, "prodi" => $mn->id],
            ["kode" => "MN201", "nama" => "Manajemen Pemasaran", "sks" => 3, "semester" => 4, "prodi" => $mn->id],
            ["kode" => "MN202", "nama" => "Manajemen Keuangan", "sks" => 3, "semester" => 4, "prodi" => $mn->id],
            ["kode" => "IK101", "nama" => "Pengantar Ilmu Komunikasi", "sks" => 3, "semester" => 1, "prodi" => $ilmuKom->id],
            ["kode" => "IK102", "nama" => "Komunikasi Massa", "sks" => 3, "semester" => 1, "prodi" => $ilmuKom->id],
            ["kode" => "IK103", "nama" => "Jurnalistik Dasar", "sks" => 3, "semester" => 2, "prodi" => $ilmuKom->id],
            ["kode" => "IK201", "nama" => "Public Relations", "sks" => 3, "semester" => 3, "prodi" => $ilmuKom->id],
            ["kode" => "IK202", "nama" => "Periklanan", "sks" => 3, "semester" => 4, "prodi" => $ilmuKom->id],
            ["kode" => "AN101", "nama" => "Pengantar Administrasi Negara", "sks" => 3, "semester" => 1, "prodi" => $adNeg->id],
            ["kode" => "AN102", "nama" => "Teori Birokrasi", "sks" => 3, "semester" => 2, "prodi" => $adNeg->id],
            ["kode" => "AN103", "nama" => "Kebijakan Publik", "sks" => 3, "semester" => 3, "prodi" => $adNeg->id],
            ["kode" => "AN201", "nama" => "Manajemen Pelayanan Publik", "sks" => 3, "semester" => 4, "prodi" => $adNeg->id],
        ];
        $mkModels = [];
        foreach ($semuaMk as $mk) {
            $mkModels[$mk["kode"]] = MataKuliah::create(["kode_mk" => $mk["kode"], "nama_mk" => $mk["nama"], "sks" => $mk["sks"], "semester" => $mk["semester"], "prodi_id" => $mk["prodi"]]);
        }

        // Kelas
        $kelasList = [
            ["mk" => "TI101", "kelas" => "TI-1A"], ["mk" => "TI102", "kelas" => "TI-1A"], ["mk" => "TI103", "kelas" => "TI-1A"],
            ["mk" => "TI201", "kelas" => "TI-2A"], ["mk" => "TI202", "kelas" => "TI-2A"], ["mk" => "TI203", "kelas" => "TI-2A"],
            ["mk" => "SI101", "kelas" => "SI-1A"], ["mk" => "SI102", "kelas" => "SI-1A"],
            ["mk" => "AK101", "kelas" => "AK-1A"], ["mk" => "AK102", "kelas" => "AK-1A"],
            ["mk" => "MN101", "kelas" => "MN-1A"],
            ["mk" => "IK101", "kelas" => "IK-1A"], ["mk" => "IK102", "kelas" => "IK-1A"],
            ["mk" => "AN101", "kelas" => "AN-1A"],
        ];
        $dosenIds = Dosen::pluck("id", "jabatan");
        $dosenPertama = Dosen::first()->id;
        foreach ($kelasList as $kl) {
            Kelas::create(["mata_kuliah_id" => $mkModels[$kl["mk"]]->id, "dosen_id" => $dosenPertama, "nama_kelas" => $kl["kelas"], "tahun_ajaran" => "2024/2025 Ganjil"]);
        }

        // FAQ
        $faqs = [
            ["Biaya SPP per semester berapa?", "Biaya SPP per semester S1 di Universitas Adzkia: FTI Rp 5.000.000,-, FEB Rp 4.500.000,-, FISIP Rp 4.000.000,-. Pembayaran via Mandiri/BRI atau langsung ke bagian keuangan.", "Biaya"],
            ["Apakah ada biaya gedung?", "Ya, biaya pengembangan pendidikan (gedung) dibayar sekali di awal sebesar Rp 3.000.000,- untuk semua prodi. Termasuk akses lab, perpustakaan, dan wifi.", "Biaya"],
            ["Apa saja jalur pendaftaran?", "Jalur: 1) Prestasi Akademik (rapor) – gratis, 2) Ujian Tulis, 3) Beasiswa KIP Kuliah. Dibuka Maret–Agustus setiap tahun.", "Pendaftaran"],
            ["Bagaimana daftar ulang?", "Bayar biaya pengembangan + SPP awal, serahkan ijazah asli + SKHUN + pas foto, isi formulir registrasi online. Batas 2 minggu setelah pengumuman.", "Pendaftaran"],
            ["Siapa rektor Universitas Adzkia?", "Rektor: Prof. Dr. H. Ahmad Zaki, M.Si (sejak 2023).", "Informasi Kampus"],
            ["Apa visi misi Universitas Adzkia?", "Visi: Universitas unggul dan berkarakter Islami tingkat nasional tahun 2035. Misi: 1) Pendidikan berkualitas, 2) Penelitian & pengabdian, 3) SDM profesional berakhlak mulia.", "Informasi Kampus"],
            ["Dimana alamat kampus?", "Jl. Raya Adzkia No. 10, Guguak, Lima Puluh Kota, Sumbar. Telp: (0752) 98765, Email: info@adzkia.ac.id", "Kontak"],
            ["Apa saja UKM?", "UKM: 1) Olahraga (Futsal, Basket, Voli, Silat), 2) Seni (Teater, Musik, Paduan Suara, Tari), 3) Keilmuan (IT, Debat, Jurnalistik), 4) Kerohanian (Rohis, LDK).", "Mahasiswa"],
            ["Apa fasilitas kampus?", "Lab komputer (3), lab bahasa, perpustakaan digital, wifi 24 jam, ruang UKM, lapangan futsal/basket/voli, masjid, kantin, parkir, ruang kuliah ber-AC. Akses dengan KTM aktif.", "Fasilitas"],
            ["Apakah ada beasiswa?", "1) Prestasi Akademik (IPK >= 3.5, potongan 50%), 2) Kurang Mampu (SKTM, potongan 25-50%), 3) Non-Akademik (juara prov/nasional), 4) KIP Kuliah. Info di kemahasiswaan.", "Mahasiswa"],
            ["Bagaimana aturan cuti kuliah?", "Cuti maksimal 2 semester berturut-turut. Ajukan formulir + surat keterangan ke prodi. Tidak ada biaya SPP selama cuti.", "Akademik"],
            ["Apa syarat kelulusan?", "Minimal 144 SKS, IPK >= 2.00, tanpa nilai D/E, lulus skripsi, TOEFL >= 400, lulus PKM/KKN. Yudisium tiap akhir semester.", "Akademik"],
        ];
        foreach ($faqs as $f) {
            Faq::create(["pertanyaan" => $f[0], "jawaban" => $f[1], "kategori" => $f[2], "is_active" => true]);
        }

        // Informasi Kampus
        $infoKampus = [
            ["nama_kampus", "Universitas Adzkia"],
            ["alamat", "Jl. Raya Adzkia No. 10, Guguak, Lima Puluh Kota, Sumatera Barat"],
            ["telepon", "(0752) 98765"], ["email", "info@adzkia.ac.id"],
            ["website", "https://www.adzkia.ac.id"],
            ["rektor", "Prof. Dr. H. Ahmad Zaki, M.Si"],
            ["visi", "Universitas unggul dan berkarakter Islami tingkat nasional tahun 2035."],
            ["misi", "1) Pendidikan berkualitas, 2) Penelitian & pengabdian, 3) SDM profesional berakhlak mulia."],
            ["akreditasi", "BAN-PT: Baik Sekali"],
            ["tahun_berdiri", "2010"],
            ["jumlah_mahasiswa", "3.500+ mahasiswa aktif"],
            ["jumlah_dosen", "45+ dosen tetap, 20 dosen tidak tetap"],
        ];
        foreach ($infoKampus as $ik) {
            InformasiKampus::create(["key" => $ik[0], "value" => $ik[1], "deskripsi" => $ik[0]]);
        }

        // Kalender Akademik
        $kalender = [
            ["Pendaftaran Mahasiswa Baru", "2026-03-01", "2026-08-31", "Pendaftaran"],
            ["UTS Semester Ganjil", "2026-10-12", "2026-10-24", "Akademik"],
            ["UAS Semester Ganjil", "2026-12-14", "2026-12-28", "Akademik"],
            ["Libur Semester Ganjil", "2026-12-29", "2027-01-11", "Libur"],
            ["Awal Kuliah Semester Genap", "2027-01-18", null, "Akademik"],
            ["UTS Semester Genap", "2027-03-22", "2027-04-02", "Akademik"],
            ["UAS Semester Genap", "2027-05-31", "2027-06-12", "Akademik"],
            ["Libur Semester Genap", "2027-06-14", "2027-07-25", "Libur"],
            ["Yudisium", "2026-12-20", null, "Akademik"],
            ["Wisuda Tahunan", "2027-07-15", null, "Akademik"],
        ];
        foreach ($kalender as $k) {
            KalenderAkademik::create(["acara" => $k[0], "tanggal_mulai" => $k[1], "tanggal_selesai" => $k[2], "kategori" => $k[3]]);
        }
    }
}
