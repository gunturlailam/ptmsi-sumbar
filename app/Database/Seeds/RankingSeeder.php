<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RankingSeeder extends Seeder
{
    public function run()
    {
        // Check if atlet data exists
        $atletCount = $this->db->table('atlet')->countAllResults();

        if ($atletCount < 5) {
            echo "Warning: Not enough atlet data. Please seed atlet table first.\n";
            echo "Skipping ranking seeder...\n";
            return;
        }

        // Check if event data exists
        $eventCount = $this->db->table('event')->countAllResults();

        if ($eventCount < 2) {
            echo "Warning: Not enough event data. Please seed event table first.\n";
            echo "Skipping pertandingan and hasil seeder...\n";
        }

        // Get actual atlet IDs from database
        $atlets = $this->db->table('atlet')->select('id_atlet, kategori_usia')->get()->getResultArray();

        // Sample data for ranking table
        $rankingData = [];
        $posisiPerKategori = [];

        foreach ($atlets as $index => $atlet) {
            $kategori = $atlet['kategori_usia'];

            // Initialize posisi for this kategori if not exists
            if (!isset($posisiPerKategori[$kategori])) {
                $posisiPerKategori[$kategori] = 1;
            }

            $rankingData[] = [
                'id_atlet' => $atlet['id_atlet'],
                'kategori_usia' => $kategori,
                'posisi' => $posisiPerKategori[$kategori],
                'poin' => 1000 - ($posisiPerKategori[$kategori] * 50),
                'tanggal_berlaku' => '2025-01-01',
            ];

            $posisiPerKategori[$kategori]++;
        }

        $this->db->table('ranking')->insertBatch($rankingData);
        echo "Ranking data seeded successfully!\n";

        // Only seed pertandingan and hasil if event data exists
        if ($eventCount < 2) {
            return;
        }

        // Sample data for pertandingan table using actual atlet IDs
        $pertandinganData = [];
        if (count($atlets) >= 4) {
            $pertandinganData = [
                [
                    'id_event' => 1,
                    'babak' => 'Final',
                    'id_atlet1' => $atlets[0]['id_atlet'],
                    'id_atlet2' => $atlets[1]['id_atlet'],
                    'jadwal' => '2025-11-20 14:00:00',
                    'venue' => 'GOR Haji Agus Salim',
                ],
                [
                    'id_event' => 1,
                    'babak' => 'Semi Final',
                    'id_atlet1' => $atlets[2]['id_atlet'],
                    'id_atlet2' => $atlets[3]['id_atlet'],
                    'jadwal' => '2025-11-20 10:00:00',
                    'venue' => 'GOR Haji Agus Salim',
                ],
            ];

            if (count($atlets) >= 6) {
                $pertandinganData[] = [
                    'id_event' => 1,
                    'babak' => 'Perempat Final',
                    'id_atlet1' => $atlets[4]['id_atlet'],
                    'id_atlet2' => $atlets[5]['id_atlet'],
                    'jadwal' => '2025-11-19 14:00:00',
                    'venue' => 'GOR Haji Agus Salim',
                ];
            }

            if (count($atlets) >= 7 && $eventCount >= 2) {
                $pertandinganData[] = [
                    'id_event' => 2,
                    'babak' => 'Final',
                    'id_atlet1' => $atlets[0]['id_atlet'],
                    'id_atlet2' => $atlets[6]['id_atlet'],
                    'jadwal' => '2025-10-15 15:00:00',
                    'venue' => 'GOR Universitas Negeri Padang',
                ];
            }
        }

        if (!empty($pertandinganData)) {
            $this->db->table('pertandingan')->insertBatch($pertandinganData);
            echo "Pertandingan data seeded successfully!\n";

            // Sample data for hasil table
            $hasilData = [];
            $pertandinganIds = $this->db->table('pertandingan')->select('id_pertandingan')->orderBy('id_pertandingan', 'DESC')->limit(count($pertandinganData))->get()->getResultArray();

            foreach ($pertandinganIds as $index => $p) {
                $hasilData[] = [
                    'id_pertandingan' => $p['id_pertandingan'],
                    'id_pemenang_atlet' => $pertandinganData[$index]['id_atlet1'],
                    'skor' => '3-1 (11-9, 11-7, 9-11, 11-6)',
                    'id_pelapor' => null,
                    'dicatat_pada' => date('Y-m-d H:i:s'),
                ];
            }

            if (!empty($hasilData)) {
                $this->db->table('hasil')->insertBatch($hasilData);
                echo "Hasil data seeded successfully!\n";
            }
        }

        echo "\nRanking, Pertandingan, dan Hasil seeder completed!\n";
    }
}
