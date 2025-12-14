<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TournamentEventSeeder extends Seeder
{
    public function run()
    {
        // Update existing events with tournament registration data
        $data = [
            [
                'id_event' => 1,
                'nama_event' => 'Kejuaraan Provinsi Sumatera Barat 2025',
                'deskripsi' => 'Kejuaraan tenis meja tingkat provinsi untuk semua kategori usia. Turnamen ini diselenggarakan untuk mencari bibit-bibit terbaik di Sumatera Barat.',
                'kategori_usia' => 'Senior',
                'kategori_gender' => 'campuran',
                'kuota_peserta' => 50,
                'biaya_pendaftaran' => 150000.00,
                'tingkat' => 'provinsi',
                'syarat_khusus' => 'Atlet harus memiliki KTA yang masih berlaku dan surat keterangan sehat dari dokter.',
                'batas_pendaftaran' => '2025-12-20'
            ],
            [
                'id_event' => 3,
                'nama_event' => 'Kejuaraan Junior Sumatera Barat 2025',
                'deskripsi' => 'Kejuaraan tenis meja tingkat provinsi khusus untuk kategori junior se-Sumatera Barat. Ajang bergengsi untuk atlet muda Sumbar.',
                'kategori_usia' => 'U-18',
                'kategori_gender' => 'campuran',
                'kuota_peserta' => 64,
                'biaya_pendaftaran' => 125000.00,
                'tingkat' => 'provinsi',
                'syarat_khusus' => 'Atlet maksimal berusia 18 tahun dan terdaftar di klub PTMSI Sumatera Barat.',
                'status' => 'aktif',
                'batas_pendaftaran' => '2025-12-15'
            ]
        ];

        foreach ($data as $event) {
            $this->db->table('event')->where('id_event', $event['id_event'])->update($event);
        }

        // Insert new tournament events
        $newEvents = [
            [
                'judul' => 'Open Tournament Padang 2025',
                'nama_event' => 'Open Tournament Padang 2025',
                'deskripsi' => 'Turnamen terbuka untuk semua kalangan dengan hadiah menarik.',
                'kategori_usia' => 'U-15',
                'kategori_gender' => 'putra',
                'kuota_peserta' => 32,
                'biaya_pendaftaran' => 100000.00,
                'tingkat' => 'kota',
                'syarat_khusus' => 'Khusus untuk atlet putra kategori U-15.',
                'tanggal_mulai' => '2025-12-25',
                'tanggal_selesai' => '2025-12-27',
                'lokasi' => 'GOR Haji Agus Salim Padang',
                'batas_pendaftaran' => '2025-12-22',
                'status' => 'aktif',
                'id_turnamen' => 1,
                'id_klub_penyelenggara' => 1
            ],
            [
                'judul' => 'Kejuaraan Putri Sumatera Barat',
                'nama_event' => 'Kejuaraan Putri Sumatera Barat 2025',
                'deskripsi' => 'Kejuaraan khusus untuk atlet putri se-Sumatera Barat.',
                'kategori_usia' => 'Senior',
                'kategori_gender' => 'putri',
                'kuota_peserta' => 40,
                'biaya_pendaftaran' => 0.00,
                'tingkat' => 'provinsi',
                'syarat_khusus' => 'Khusus untuk atlet putri yang terdaftar di PTMSI Sumbar.',
                'tanggal_mulai' => '2025-12-30',
                'tanggal_selesai' => '2026-01-02',
                'lokasi' => 'GOR Universitas Negeri Padang',
                'batas_pendaftaran' => '2025-12-25',
                'status' => 'aktif',
                'id_turnamen' => 2,
                'id_klub_penyelenggara' => 2
            ]
        ];

        $this->db->table('event')->insertBatch($newEvents);

        echo "Tournament events seeded successfully!\n";
    }
}
