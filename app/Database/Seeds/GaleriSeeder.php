<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Foto Kegiatan
            [
                'judul' => 'Pembukaan Kejuaraan Tenis Meja Sumbar 2025',
                'jenis_media' => 'gambar',
                'url' => 'uploads/galeri/pembukaan-kejuaraan.jpg',
                'id_event' => 1, // Sesuaikan dengan ID event yang ada
                'diunggah_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Pertandingan Final Tunggal Putra',
                'jenis_media' => 'gambar',
                'url' => 'uploads/galeri/final-tunggal-putra.jpg',
                'id_event' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'judul' => 'Penyerahan Medali Juara',
                'jenis_media' => 'gambar',
                'url' => 'uploads/galeri/penyerahan-medali.jpg',
                'id_event' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'judul' => 'Latihan Bersama Atlet Muda',
                'jenis_media' => 'gambar',
                'url' => 'uploads/galeri/latihan-atlet-muda.jpg',
                'id_event' => null,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'judul' => 'Rapat Pengurus PTMSI Sumbar',
                'jenis_media' => 'gambar',
                'url' => 'uploads/galeri/rapat-pengurus.jpg',
                'id_event' => null,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],

            // Video Highlight
            [
                'judul' => 'Highlight Final Kejuaraan Sumbar 2025',
                'jenis_media' => 'video',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Ganti dengan URL video asli
                'id_event' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'judul' => 'Best Moments Turnamen Tenis Meja',
                'jenis_media' => 'video',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'id_event' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            [
                'judul' => 'Tutorial Teknik Servis Tenis Meja',
                'jenis_media' => 'video',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'id_event' => null,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],

            // Dokumentasi Resmi
            [
                'judul' => 'Pelantikan Pengurus PTMSI Sumbar Periode 2023-2027',
                'jenis_media' => 'gambar',
                'url' => 'uploads/galeri/pelantikan-pengurus.jpg',
                'id_event' => null,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-8 days')),
            ],
            [
                'judul' => 'Kunjungan Ketua PTMSI Pusat',
                'jenis_media' => 'gambar',
                'url' => 'uploads/galeri/kunjungan-ketua-pusat.jpg',
                'id_event' => null,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-9 days')),
            ],
        ];

        // Insert data
        $this->db->table('galeri')->insertBatch($data);
    }
}
