<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Ratings untuk atlet 1
            [
                'id_atlet' => 1,
                'id_penilai' => 2,
                'rating' => 5,
                'kategori' => 'teknik',
                'komentar' => 'Teknik pukulan sangat bagus dan konsisten',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-5 days'))
            ],
            [
                'id_atlet' => 1,
                'id_penilai' => 3,
                'rating' => 4,
                'kategori' => 'kecepatan',
                'komentar' => 'Kecepatan gerak cukup baik',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-4 days'))
            ],
            [
                'id_atlet' => 1,
                'id_penilai' => 4,
                'rating' => 5,
                'kategori' => 'ketahanan',
                'komentar' => 'Stamina luar biasa, tidak terlihat lelah',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'id_atlet' => 1,
                'id_penilai' => 5,
                'rating' => 4,
                'kategori' => 'mental',
                'komentar' => 'Mental cukup kuat menghadapi tekanan',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'id_atlet' => 1,
                'id_penilai' => 2,
                'rating' => 5,
                'kategori' => 'sportivitas',
                'komentar' => 'Sangat sportif dan menghormati lawan',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            // Ratings untuk atlet 2
            [
                'id_atlet' => 2,
                'id_penilai' => 1,
                'rating' => 4,
                'kategori' => 'teknik',
                'komentar' => 'Teknik cukup baik, perlu perbaikan di forehand',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-5 days'))
            ],
            [
                'id_atlet' => 2,
                'id_penilai' => 3,
                'rating' => 3,
                'kategori' => 'kecepatan',
                'komentar' => 'Kecepatan masih perlu ditingkatkan',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-4 days'))
            ],
            [
                'id_atlet' => 2,
                'id_penilai' => 4,
                'rating' => 4,
                'kategori' => 'ketahanan',
                'komentar' => 'Ketahanan cukup baik',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'id_atlet' => 2,
                'id_penilai' => 5,
                'rating' => 3,
                'kategori' => 'mental',
                'komentar' => 'Mental perlu diperkuat, mudah terpengaruh',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'id_atlet' => 2,
                'id_penilai' => 1,
                'rating' => 4,
                'kategori' => 'sportivitas',
                'komentar' => 'Sportif dan baik dalam berkomunikasi',
                'dibuat_pada' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ]
        ];

        $this->db->table('rating_atlet')->insertBatch($data);
    }
}
