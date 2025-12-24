<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_user' => 1,
                'tipe' => 'event',
                'judul' => 'Event Baru: Kejuaraan Nasional Junior 2025',
                'pesan' => 'Event baru telah dibuat. Daftarkan tim Anda sekarang!',
                'id_referensi' => 1,
                'tipe_referensi' => 'event',
                'dibaca' => false,
                'dibuat_pada' => date('Y-m-d H:i:s')
            ],
            [
                'id_user' => 1,
                'tipe' => 'pertandingan',
                'judul' => 'Pertandingan Anda Dijadwalkan',
                'pesan' => 'Pertandingan Anda dijadwalkan pada 25 Desember 2024 pukul 14:00',
                'id_referensi' => 1,
                'tipe_referensi' => 'pertandingan',
                'dibaca' => false,
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'id_user' => 1,
                'tipe' => 'hasil',
                'judul' => 'Hasil Pertandingan Tersedia',
                'pesan' => 'Hasil pertandingan Anda telah diinput oleh wasit',
                'id_referensi' => 1,
                'tipe_referensi' => 'hasil',
                'dibaca' => true,
                'dibaca_pada' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'id_user' => 1,
                'tipe' => 'ranking',
                'judul' => 'Ranking Anda Diperbarui',
                'pesan' => 'Ranking Anda telah diperbarui berdasarkan hasil pertandingan terbaru',
                'id_referensi' => 1,
                'tipe_referensi' => 'ranking',
                'dibaca' => true,
                'dibaca_pada' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'id_user' => 1,
                'tipe' => 'sistem',
                'judul' => 'Pemeliharaan Sistem',
                'pesan' => 'Sistem akan dirawat pada 26 Desember 2024 pukul 22:00-23:00',
                'dibaca' => true,
                'dibaca_pada' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-4 days'))
            ]
        ];

        $this->db->table('notifikasi')->insertBatch($data);
    }
}
