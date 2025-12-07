<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LayananOnlineSeeder extends Seeder
{
    public function run()
    {
        // Check if required tables have data
        $atletCount = $this->db->table('atlet')->countAllResults();
        $eventCount = $this->db->table('event')->countAllResults();

        if ($atletCount < 5 || $eventCount < 2) {
            echo "Warning: Not enough atlet or event data. Skipping seeder...\n";
            return;
        }

        // Sample pendaftaran event data
        $pendaftaranData = [
            [
                'id_event' => 1,
                'tipe_pendaftar' => 'atlet',
                'id_klub' => null,
                'id_atlet' => 1,
                'tanggal_daftar' => '2025-11-01 10:30:00',
                'status_pembayaran' => 'lunas',
                'id_verifikator' => null,
            ],
            [
                'id_event' => 1,
                'tipe_pendaftar' => 'atlet',
                'id_klub' => null,
                'id_atlet' => 2,
                'tanggal_daftar' => '2025-11-02 14:15:00',
                'status_pembayaran' => 'pending',
                'id_verifikator' => null,
            ],
            [
                'id_event' => 2,
                'tipe_pendaftar' => 'klub',
                'id_klub' => 1,
                'id_atlet' => null,
                'tanggal_daftar' => '2025-10-15 09:00:00',
                'status_pembayaran' => 'lunas',
                'id_verifikator' => null,
            ],
        ];

        $this->db->table('pendaftaran_event')->insertBatch($pendaftaranData);
        echo "Pendaftaran event data seeded successfully!\n";

        // Sample pesan kontak data
        $pesanKontakData = [
            [
                'nama' => 'Andi Wijaya',
                'email' => 'andi.wijaya@email.com',
                'telepon' => '081234567890',
                'subjek' => 'Pendaftaran Atlet',
                'pesan' => 'Saya ingin menanyakan persyaratan pendaftaran atlet baru untuk kategori U-15.',
                'dibuat_pada' => '2025-12-01 10:30:00',
                'status' => 'baru',
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nur@email.com',
                'telepon' => '081298765432',
                'subjek' => 'Event & Turnamen',
                'pesan' => 'Kapan jadwal turnamen provinsi berikutnya? Apakah sudah dibuka pendaftaran?',
                'dibuat_pada' => '2025-12-02 14:20:00',
                'status' => 'dibalas',
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'telepon' => '081356789012',
                'subjek' => 'Pendaftaran Klub',
                'pesan' => 'Kami ingin mendirikan klub tenis meja baru di Bukittinggi. Mohon informasi prosedurnya.',
                'dibuat_pada' => '2025-12-03 09:15:00',
                'status' => 'baru',
            ],
            [
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@email.com',
                'telepon' => '081445678901',
                'subjek' => 'Sertifikasi',
                'pesan' => 'Saya ingin mengikuti pelatihan sertifikasi wasit daerah. Bagaimana cara mendaftarnya?',
                'dibuat_pada' => '2025-12-04 11:45:00',
                'status' => 'baru',
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@email.com',
                'telepon' => '081523456789',
                'subjek' => 'Pengaduan',
                'pesan' => 'Saya ingin melaporkan ketidaksesuaian hasil pertandingan pada event terakhir.',
                'dibuat_pada' => '2025-12-05 16:30:00',
                'status' => 'diproses',
            ],
        ];

        $this->db->table('pesan_kontak')->insertBatch($pesanKontakData);
        echo "Pesan kontak data seeded successfully!\n";

        echo "\nLayanan Online seeder completed!\n";
    }
}
