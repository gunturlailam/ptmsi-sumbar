<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DokumenSeeder extends Seeder
{
    public function run()
    {
        // Get admin user UUID
        $adminUser = $this->db->table('user')->where('peran', 'admin')->get()->getRow();
        if (!$adminUser) {
            echo "Warning: No admin user found. Skipping dokumen seeder...\n";
            return;
        }

        $adminId = $adminUser->id_user;

        $data = [
            // AD/ART
            [
                'judul' => 'Anggaran Dasar PTMSI',
                'kategori' => 'AD/ART',
                'file_url' => 'uploads/dokumen/ad-ptmsi.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Anggaran Rumah Tangga PTMSI',
                'kategori' => 'AD/ART',
                'file_url' => 'uploads/dokumen/art-ptmsi.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s'),
            ],
            // Peraturan Pertandingan
            [
                'judul' => 'Peraturan Pertandingan ITTF 2024',
                'kategori' => 'Peraturan Pertandingan',
                'file_url' => 'uploads/dokumen/peraturan-ittf-2024.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'judul' => 'Peraturan Pertandingan PTMSI',
                'kategori' => 'Peraturan Pertandingan',
                'file_url' => 'uploads/dokumen/peraturan-ptmsi.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'judul' => 'Kode Etik Atlet dan Ofisial',
                'kategori' => 'Peraturan Pertandingan',
                'file_url' => 'uploads/dokumen/kode-etik.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            // Panduan Klub
            [
                'judul' => 'Panduan Pendirian Klub Tenis Meja',
                'kategori' => 'Panduan Klub',
                'file_url' => 'uploads/dokumen/panduan-pendirian-klub.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'judul' => 'Panduan Administrasi Klub',
                'kategori' => 'Panduan Klub',
                'file_url' => 'uploads/dokumen/panduan-administrasi-klub.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'judul' => 'Panduan Pembinaan Atlet Usia Dini',
                'kategori' => 'Panduan Klub',
                'file_url' => 'uploads/dokumen/panduan-pembinaan-usia-dini.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            // SOP Kejuaraan
            [
                'judul' => 'SOP Penyelenggaraan Kejuaraan Tingkat Provinsi',
                'kategori' => 'SOP Kejuaraan',
                'file_url' => 'uploads/dokumen/sop-kejuaraan-provinsi.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],
            [
                'judul' => 'SOP Perwasitan Pertandingan',
                'kategori' => 'SOP Kejuaraan',
                'file_url' => 'uploads/dokumen/sop-perwasitan.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-8 days')),
            ],
            // Formulir
            [
                'judul' => 'Formulir Pendaftaran Atlet',
                'kategori' => 'Formulir',
                'file_url' => 'uploads/dokumen/formulir-pendaftaran-atlet.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-9 days')),
            ],
            [
                'judul' => 'Formulir Pendaftaran Klub',
                'kategori' => 'Formulir',
                'file_url' => 'uploads/dokumen/formulir-pendaftaran-klub.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            [
                'judul' => 'Formulir Pendaftaran Event',
                'kategori' => 'Formulir',
                'file_url' => 'uploads/dokumen/formulir-pendaftaran-event.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-11 days')),
            ],
            [
                'judul' => 'Formulir Perpindahan Klub',
                'kategori' => 'Formulir',
                'file_url' => 'uploads/dokumen/formulir-perpindahan-klub.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-12 days')),
            ],
            [
                'judul' => 'Formulir Pembaruan Data Atlet',
                'kategori' => 'Formulir',
                'file_url' => 'uploads/dokumen/formulir-pembaruan-data.pdf',
                'id_pengunggah' => $adminId,
                'diunggah_pada' => date('Y-m-d H:i:s', strtotime('-13 days')),
            ],
        ];

        $this->db->table('dokumen')->insertBatch($data);
        echo "Dokumen seeded successfully!\n";
    }
}
