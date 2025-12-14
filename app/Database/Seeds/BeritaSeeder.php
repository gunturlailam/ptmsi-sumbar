<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        // Get admin user UUID
        $adminUser = $this->db->table('user')->where('peran', 'admin')->get()->getRow();
        if (!$adminUser) {
            echo "Warning: No admin user found. Skipping berita seeder...\n";
            return;
        }

        $adminId = $adminUser->id_user;

        // Sample data for berita table
        $beritaData = [
            [
                'judul' => 'Kejuaraan Tenis Meja Sumbar 2025 Resmi Dibuka',
                'slug' => 'kejuaraan-tenis-meja-sumbar-2025-resmi-dibuka',
                'konten' => 'Kejuaraan Tenis Meja Sumatera Barat 2025 resmi dibuka oleh Ketua PTMSI Sumbar. Event ini diikuti oleh 150 atlet dari berbagai klub di Sumatera Barat. Pertandingan akan berlangsung selama 5 hari di GOR Haji Agus Salim Padang.',
                'foto' => 'uploads/berita/kejuaraan-2025.jpg',
                'kategori' => 'kejuaraan',
                'id_penulis' => $adminId,
                'tanggal_publikasi' => date('Y-m-d H:i:s'),
                'status' => 'published',
            ],
            [
                'judul' => 'Atlet Sumbar Raih Medali Emas di Kejuaraan Nasional',
                'slug' => 'atlet-sumbar-raih-medali-emas-kejuaraan-nasional',
                'konten' => 'Atlet tenis meja Sumatera Barat berhasil meraih medali emas pada Kejuaraan Nasional Tenis Meja 2025. Prestasi gemilang ini diraih oleh Ahmad Rizki di kategori tunggal putra senior.',
                'foto' => 'uploads/berita/medali-emas.jpg',
                'kategori' => 'atlet',
                'id_penulis' => $adminId,
                'tanggal_publikasi' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'status' => 'published',
            ],
            [
                'judul' => 'Pengumuman: Pendaftaran Atlet Baru Dibuka',
                'slug' => 'pengumuman-pendaftaran-atlet-baru-dibuka',
                'konten' => 'PTMSI Sumatera Barat membuka pendaftaran atlet baru untuk periode 2025. Pendaftaran dibuka mulai 1 Desember 2025 hingga 31 Januari 2026. Informasi lengkap dapat dilihat di website resmi.',
                'foto' => 'uploads/berita/pendaftaran-atlet.jpg',
                'kategori' => 'pengumuman',
                'id_penulis' => $adminId,
                'tanggal_publikasi' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'status' => 'published',
            ],
            [
                'judul' => 'Tips Meningkatkan Teknik Forehand dalam Tenis Meja',
                'slug' => 'tips-meningkatkan-teknik-forehand-tenis-meja',
                'konten' => 'Teknik forehand adalah salah satu teknik dasar yang penting dalam tenis meja. Artikel ini membahas cara-cara meningkatkan teknik forehand dengan latihan yang tepat dan konsisten.',
                'foto' => 'uploads/berita/tips-forehand.jpg',
                'kategori' => 'artikel',
                'id_penulis' => $adminId,
                'tanggal_publikasi' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'status' => 'published',
            ],
            [
                'judul' => 'Program Pembinaan Usia Dini PTMSI Sumbar',
                'slug' => 'program-pembinaan-usia-dini-ptmsi-sumbar',
                'konten' => 'PTMSI Sumbar meluncurkan program pembinaan usia dini untuk anak-anak usia 6-12 tahun. Program ini bertujuan untuk mencari dan mengembangkan bibit-bibit atlet tenis meja berbakat.',
                'foto' => 'uploads/berita/pembinaan-usia-dini.jpg',
                'kategori' => 'artikel',
                'id_penulis' => $adminId,
                'tanggal_publikasi' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'status' => 'published',
            ],
        ];

        $this->db->table('berita')->insertBatch($beritaData);
        echo "Berita seeded successfully!\n";
    }
}
