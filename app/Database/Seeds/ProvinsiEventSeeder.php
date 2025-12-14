<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProvinsiEventSeeder extends Seeder
{
    public function run()
    {
        // Update existing events to be province-level only
        $updateData = [
            [
                'id_event' => 1,
                'nama_event' => 'Kejuaraan Provinsi Sumatera Barat 2025',
                'deskripsi' => 'Kejuaraan tenis meja tingkat provinsi untuk semua kategori usia se-Sumatera Barat.',
                'kategori_usia' => 'Senior',
                'kategori_gender' => 'campuran',
                'kuota_peserta' => 50,
                'biaya_pendaftaran' => 150000.00,
                'tingkat' => 'provinsi',
                'syarat_khusus' => 'Atlet harus terdaftar di klub PTMSI Sumatera Barat dan memiliki KTA yang masih berlaku.',
                'batas_pendaftaran' => '2025-12-20'
            ],
            [
                'id_event' => 3,
                'nama_event' => 'Kejuaraan Junior Sumatera Barat 2025',
                'deskripsi' => 'Kejuaraan tenis meja tingkat provinsi khusus untuk kategori junior se-Sumatera Barat.',
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

        foreach ($updateData as $event) {
            $this->db->table('event')->where('id_event', $event['id_event'])->update($event);
        }

        // Add more province-level events
        $newEvents = [
            [
                'judul' => 'Kejuaraan Veteran Sumbar 2025',
                'nama_event' => 'Kejuaraan Veteran Sumatera Barat 2025',
                'deskripsi' => 'Kejuaraan khusus untuk atlet veteran (40+ tahun) se-Sumatera Barat.',
                'kategori_usia' => 'Veteran',
                'kategori_gender' => 'campuran',
                'kuota_peserta' => 32,
                'biaya_pendaftaran' => 100000.00,
                'tingkat' => 'provinsi',
                'syarat_khusus' => 'Atlet minimal berusia 40 tahun dan terdaftar di PTMSI Sumbar.',
                'tanggal_mulai' => '2026-01-15',
                'tanggal_selesai' => '2026-01-17',
                'lokasi' => 'GOR Bukittinggi',
                'batas_pendaftaran' => '2026-01-10',
                'status' => 'aktif',
                'id_turnamen' => 1,
                'id_klub_penyelenggara' => 3
            ],
            [
                'judul' => 'Kejuaraan Pelajar Sumbar 2025',
                'nama_event' => 'Kejuaraan Pelajar Sumatera Barat 2025',
                'deskripsi' => 'Kejuaraan tenis meja untuk pelajar SMP dan SMA se-Sumatera Barat.',
                'kategori_usia' => 'U-15',
                'kategori_gender' => 'campuran',
                'kuota_peserta' => 48,
                'biaya_pendaftaran' => 75000.00,
                'tingkat' => 'provinsi',
                'syarat_khusus' => 'Peserta harus pelajar aktif SMP/SMA di Sumatera Barat.',
                'tanggal_mulai' => '2026-02-01',
                'tanggal_selesai' => '2026-02-03',
                'lokasi' => 'GOR Payakumbuh',
                'batas_pendaftaran' => '2026-01-25',
                'status' => 'aktif',
                'id_turnamen' => 2,
                'id_klub_penyelenggara' => 1
            ],
            [
                'judul' => 'Piala Gubernur Sumbar 2025',
                'nama_event' => 'Piala Gubernur Sumatera Barat 2025',
                'deskripsi' => 'Turnamen bergengsi tingkat provinsi dengan hadiah dari Gubernur Sumatera Barat.',
                'kategori_usia' => 'Senior',
                'kategori_gender' => 'putra',
                'kuota_peserta' => 32,
                'biaya_pendaftaran' => 200000.00,
                'tingkat' => 'provinsi',
                'syarat_khusus' => 'Khusus atlet putra senior terbaik se-Sumatera Barat.',
                'tanggal_mulai' => '2026-03-01',
                'tanggal_selesai' => '2026-03-03',
                'lokasi' => 'GOR Haji Agus Salim Padang',
                'batas_pendaftaran' => '2026-02-25',
                'status' => 'aktif',
                'id_turnamen' => 3,
                'id_klub_penyelenggara' => 1
            ]
        ];

        $this->db->table('event')->insertBatch($newEvents);

        echo "Province-level events updated successfully!\n";
        echo "All events are now appropriate for PTMSI Sumatera Barat (Province level)\n";
    }
}
