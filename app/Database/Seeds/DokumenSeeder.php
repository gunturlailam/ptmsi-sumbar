<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DokumenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul'         => 'Peraturan Pertandingan Badminton 2024',
                'kategori'      => 'Peraturan',
                'file_url'      => 'uploads/dokumen/peraturan_badminton_2024.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-30 days')),
            ],
            [
                'judul'         => 'Formulir Pendaftaran Atlet',
                'kategori'      => 'Formulir',
                'file_url'      => 'uploads/dokumen/form_pendaftaran_atlet.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-25 days')),
            ],
            [
                'judul'         => 'Formulir Pendaftaran Klub',
                'kategori'      => 'Formulir',
                'file_url'      => 'uploads/dokumen/form_pendaftaran_klub.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-25 days')),
            ],
            [
                'judul'         => 'Formulir Pendaftaran Pelatih',
                'kategori'      => 'Formulir',
                'file_url'      => 'uploads/dokumen/form_pendaftaran_pelatih.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-25 days')),
            ],
            [
                'judul'         => 'Panduan Sistem Informasi PBSI Sumbar',
                'kategori'      => 'Panduan',
                'file_url'      => 'uploads/dokumen/panduan_sistem_pbsi.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-20 days')),
            ],
            [
                'judul'         => 'Panduan Pendaftaran Online',
                'kategori'      => 'Panduan',
                'file_url'      => 'uploads/dokumen/panduan_pendaftaran_online.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-20 days')),
            ],
            [
                'judul'         => 'Laporan Kegiatan PBSI Sumbar 2023',
                'kategori'      => 'Laporan',
                'file_url'      => 'uploads/dokumen/laporan_kegiatan_2023.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-15 days')),
            ],
            [
                'judul'         => 'Laporan Keuangan PBSI Sumbar 2023',
                'kategori'      => 'Laporan',
                'file_url'      => 'uploads/dokumen/laporan_keuangan_2023.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-15 days')),
            ],
            [
                'judul'         => 'Sertifikat Akreditasi PBSI Sumbar',
                'kategori'      => 'Sertifikat',
                'file_url'      => 'uploads/dokumen/sertifikat_akreditasi.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            [
                'judul'         => 'Surat Keputusan Pengurus PBSI Sumbar 2024',
                'kategori'      => 'Peraturan',
                'file_url'      => 'uploads/dokumen/sk_pengurus_2024.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-8 days')),
            ],
            [
                'judul'         => 'Kalender Pertandingan 2024',
                'kategori'      => 'Panduan',
                'file_url'      => 'uploads/dokumen/kalender_pertandingan_2024.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'judul'         => 'Standar Operasional Prosedur (SOP) Turnamen',
                'kategori'      => 'Panduan',
                'file_url'      => 'uploads/dokumen/sop_turnamen.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'judul'         => 'Daftar Ranking Atlet Sumbar 2024',
                'kategori'      => 'Laporan',
                'file_url'      => 'uploads/dokumen/ranking_atlet_2024.xlsx',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'judul'         => 'Formulir Permohonan Surat Rekomendasi',
                'kategori'      => 'Formulir',
                'file_url'      => 'uploads/dokumen/form_surat_rekomendasi.docx',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'judul'         => 'Peraturan Anti Doping PBSI',
                'kategori'      => 'Peraturan',
                'file_url'      => 'uploads/dokumen/peraturan_anti_doping.pdf',
                'id_pengunggah' => 1,
                'diunggah_pada' => date('Y-m-d H:i:s'),
            ],
        ];

        // Create uploads directory if it doesn't exist
        if (!is_dir('uploads/dokumen')) {
            mkdir('uploads/dokumen', 0755, true);
        }

        // Create dummy files for demonstration
        foreach ($data as $item) {
            if (!file_exists($item['file_url'])) {
                $dummyContent = "Ini adalah file dummy untuk: " . $item['judul'] . "\n";
                $dummyContent .= "Kategori: " . $item['kategori'] . "\n";
                $dummyContent .= "Tanggal: " . $item['diunggah_pada'] . "\n";
                $dummyContent .= str_repeat("Lorem ipsum dolor sit amet, consectetur adipiscing elit. ", 50);

                file_put_contents($item['file_url'], $dummyContent);
            }
        }

        $this->db->table('dokumen')->insertBatch($data);
    }
}
