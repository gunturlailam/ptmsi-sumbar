<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada user dengan id_user tertentu atau sesuaikan dengan user yang ada
        $data = [
            [
                'judul' => 'Kejuaraan Tenis Meja Sumbar 2025 Resmi Dibuka',
                'slug' => 'kejuaraan-tenis-meja-sumbar-2025-resmi-dibuka',
                'konten' => 'Kejuaraan Tenis Meja Sumatera Barat 2025 resmi dibuka oleh Ketua PTMSI Sumbar. Event ini diikuti oleh 150 atlet dari berbagai klub di Sumatera Barat. Pertandingan akan berlangsung selama 5 hari di GOR Haji Agus Salim Padang.',
                'id_penulis' => '1', // Sesuaikan dengan ID user yang ada
                'tanggal_publikasi' => date('Y-m-d H:i:s'),
                'status' => 'published',
            ],
            [
                'judul' => 'Atlet Sumbar Raih Medali Emas di Kejuaraan Nasional',
                'slug' => 'atlet-sumbar-raih-medali-emas-kejuaraan-nasional',
                'konten' => 'Atlet tenis meja Sumatera Barat berhasil meraih medali emas pada Kejuaraan Nasional Tenis Meja 2025. Prestasi gemilang ini diraih oleh Ahmad Rizki di kategori tunggal putra senior.',
                'id_penulis' => '1',
                'tanggal_publikasi' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'status' => 'published',
            ],
            [
                'judul' => 'Pengumuman: Pendaftaran Atlet Baru Dibuka',
                'slug' => 'pengumuman-pendaftaran-atlet-baru-dibuka',
                'konten' => 'PTMSI Sumatera Barat membuka pendaftaran atlet baru untuk periode 2025. Pendaftaran dibuka mulai 1 Desember 2025 hingga 31 Januari 2026. Informasi lengkap dapat dilihat di website resmi.',
                'id_penulis' => '1',
                'tanggal_publikasi' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'status' => 'published',
            ],
            [
                'judul' => 'Tips Meningkatkan Teknik Forehand dalam Tenis Meja',
                'slug' => 'tips-meningkatkan-teknik-forehand-tenis-meja',
                'konten' => 'Teknik forehand adalah salah satu teknik dasar yang penting dalam tenis meja. Artikel ini membahas cara-cara meningkatkan teknik forehand dengan latihan yang tepat dan konsisten.',
                'id_penulis' => '1',
                'tanggal_publikasi' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'status' => 'published',
            ],
            [
                'judul' => 'Program Pembinaan Usia Dini PTMSI Sumbar',
                'slug' => 'program-pembinaan-usia-dini-ptmsi-sumbar',
                'konten' => 'PTMSI Sumbar meluncurkan program pembinaan usia dini untuk anak-anak usia 6-12 tahun. Program ini bertujuan untuk mencari dan mengembangkan bibit-bibit atlet tenis meja berbakat.',
                'id_penulis' => '1',
                'tanggal_publikasi' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'status' => 'published',
            ],
        ];

        // Insert data
        $this->db->table('berita')->insertBatch($data);
    }
}
