<?php

namespace App\Services;

use Illuminate\Support\Str;

class TopicClassifier
{
    private const CATEGORY_KEYWORDS = [
        'Biaya' => ['biaya', 'spp', 'ukt', 'bpp', 'spi', 'bayar', 'pembayaran', 'tagihan', 'cicilan'],
        'Pendaftaran' => ['daftar', 'pendaftaran', 'registrasi', 'syarat', 'seleksi', 'jalur masuk', 'pmb'],
        'Program Studi' => ['program studi', 'prodi', 'jurusan', 'fakultas', 'akreditasi', 'kurikulum'],
        'Dosen' => ['dosen', 'nidn', 'pengajar', 'kaprodi', 'dekan', 'jabatan'],
        // 'Mahasiswa' => ['mahasiswa', 'nim', 'angkatan', 'alumni', 'status mahasiswa'],
        'Akademik' => ['akademik', 'krs', 'sks', 'semester', 'nilai', 'ipk', 'perkuliahan'],
        'Jadwal' => ['jadwal', 'jam kuliah', 'kelas malam', 'ruang', 'hari kuliah'],
        'Kontak' => ['kontak', 'alamat', 'telepon', 'email', 'whatsapp', 'humas', 'admin kampus'],
        'Fasilitas' => ['fasilitas', 'laboratorium', 'lab', 'perpustakaan', 'wifi', 'parkir', 'asrama'],
    ];

    private const STOP_WORDS = [
        'ada',
        'adakah',
        'apa',
        'apakah',
        'bagaimana',
        'bantu',
        'bisa',
        'boleh',
        'buat',
        'dan',
        'dari',
        'di',
        'ini',
        'itu',
        'jadi',
        'jika',
        'kalau',
        'kami',
        'kampus',
        'ke',
        'mau',
        'minta',
        'mohon',
        'pada',
        'para',
        'saja',
        'saya',
        'sebagai',
        'siapa',
        'tentang',
        'terkait',
        'tolong',
        'untuk',
        'yang',
    ];

    public function classify(string $question, ?string $normalizedQuestion = null): string
    {
        $normalizedQuestion ??= Str::lower($question);

        $scores = [];

        foreach (self::CATEGORY_KEYWORDS as $category => $keywords) {
            $scores[$category] = 0;

            foreach ($keywords as $keyword) {
                if (str_contains($normalizedQuestion, $keyword)) {
                    $scores[$category]++;
                }
            }
        }

        arsort($scores);

        $bestCategory = array_key_first($scores);

        return $bestCategory !== null && ($scores[$bestCategory] ?? 0) > 0
            ? $bestCategory
            : 'Umum';
    }

    public function summarize(string $question, string $category, ?string $normalizedQuestion = null): string
    {
        $normalizedQuestion ??= Str::lower($question);
        $normalizedQuestion = preg_replace('/[^\pL\pN\s]/u', ' ', $normalizedQuestion) ?? $normalizedQuestion;
        $normalizedQuestion = preg_replace('/\s+/u', ' ', trim($normalizedQuestion)) ?? trim($normalizedQuestion);

        $tokens = array_values(array_filter(
            explode(' ', $normalizedQuestion),
            fn (string $token) => $token !== '' && ! in_array($token, self::STOP_WORDS, true)
        ));

        $summary = implode(' ', array_slice($tokens, 0, 6));

        if ($summary === '') {
            return $category;
        }

        return $category.': '.Str::headline($summary);
    }
}
