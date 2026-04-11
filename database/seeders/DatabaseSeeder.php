<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Super Admin
        User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Data Fakultas
        $f1 = Fakultas::create(['name_fakultas' => 'Fakultas Teknik', 'kode_fakultas' => 'FT']);
        $f2 = Fakultas::create(['name_fakultas' => 'Fakultas Ekonomi & Bisnis', 'kode_fakultas' => 'FEB']);

        // 3. Data Program Studi
        $p1 = ProgramStudi::create([
            'fakultas_id' => $f1->id,
            'nama_prodi' => 'Teknik Informatika',
            'jenjang' => 'S1',
            'kode_prodi' => 'TI'
        ]);

        $p2 = ProgramStudi::create([
            'fakultas_id' => $f2->id,
            'nama_prodi' => 'Akuntansi',
            'jenjang' => 'S1',
            'kode_prodi' => 'AK'
        ]);

        // 4. Data Dosen (Sekaligus buat akun User)
        $uDosen = User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        $dosen = Dosen::create([
            'nidn' => '0011223344',
            'user_id' => $uDosen->id,
            'nama' => $uDosen->name,
            'email' => $uDosen->email,
            'prodi_id' => $p1->id,
            'jabatan' => 'Lektor Kepala'
        ]);

        // 5. Data Mahasiswa (Sekaligus buat akun User)
        $uMhs = User::create([
            'name' => 'Ahmad Fauzan',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $uMhs->id,
            'nim' => '20240001',
            'nama' => $uMhs->name,
            'prodi_id' => $p1->id,
            'angkatan' => 2024,
            'status' => 'aktif'
        ]);

        // 6. Data Mata Kuliah
        $mk1 = MataKuliah::create([
            'kode_mk' => 'MK001',
            'nama_mk' => 'Pemrograman Web',
            'sks' => 3,
            'semester' => 2,
            'prodi_id' => $p1->id
        ]);

        $mk2 = MataKuliah::create([
            'kode_mk' => 'MK002',
            'nama_mk' => 'Basis Data',
            'sks' => 4,
            'semester' => 2,
            'prodi_id' => $p1->id
        ]);

        // 7. Data Kelas
        $k1 = Kelas::create([
            'mata_kuliah_id' => $mk1->id,
            'dosen_id' => $dosen->id,
            'nama_kelas' => 'TI-A',
            'tahun_ajaran' => '2023/2024 Genap'
        ]);

        $k2 = Kelas::create([
            'mata_kuliah_id' => $mk2->id,
            'dosen_id' => $dosen->id,
            'nama_kelas' => 'TI-B',
            'tahun_ajaran' => '2023/2024 Genap'
        ]);

        // 8. Data KRS (Kartu Rencana Studi)
        \App\Models\Krs::create([
            'mahasiswa_id' => 1, // ID Mahasiswa Ahmad Fauzan
            'kelas_id' => $k1->id,
            'semester' => 2,
            'tahun_ajaran' => '2023/2024 Genap',
            'status' => 'disetujui'
        ]);

        \App\Models\Krs::create([
            'mahasiswa_id' => 1,
            'kelas_id' => $k2->id,
            'semester' => 2,
            'tahun_ajaran' => '2023/2024 Genap',
            'status' => 'pending'
        ]);
    }
}
