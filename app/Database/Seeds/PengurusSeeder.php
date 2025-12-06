<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengurusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_organisasi' => 1, // Sesuaikan dengan ID organisasi yang ada
                'nama' => 'Dr. Ahmad Syafrizal',
                'jabatan' => 'Ketua Umum',
                'telepon' => '0812-3456-7890',
                'email' => 'ketua@ptmsisumbar.or.id',
                'periode_mulai' => '2023-01-01',
                'periode_selesai' => '2027-12-31',
                'status' => 'aktif',
            ],
            [
                'id_organisasi' => 1,
                'nama' => 'Ir. Budi Santoso, M.T.',
                'jabatan' => 'Sekretaris Umum',
                'telepon' => '0813-4567-8901',
                'email' => 'sekretaris@ptmsisumbar.or.id',
                'periode_mulai' => '2023-01-01',
                'periode_selesai' => '2027-12-31',
                'status' => 'aktif',
            ],
            [
                'id_organisasi' => 1,
                'nama' => 'Drs. Chandra Wijaya',
                'jabatan' => 'Bendahara Umum',
                'telepon' => '0814-5678-9012',
                'email' => 'bendahara@ptmsisumbar.or.id',
                'periode_mulai' => '2023-01-01',
                'periode_selesai' => '2027-12-31',
                'status' => 'aktif',
            ],
            [
                'id_organisasi' => 1,
                'nama' => 'Dra. Dewi Lestari, M.Pd.',
                'jabatan' => 'Wakil Ketua I',
                'telepon' => '0815-6789-0123',
                'email' => 'wakilketua1@ptmsisumbar.or.id',
                'periode_mulai' => '2023-01-01',
                'periode_selesai' => '2027-12-31',
                'status' => 'aktif',
            ],
            [
                'id_organisasi' => 1,
                'nama' => 'Eko Prasetyo, S.Pd.',
                'jabatan' => 'Wakil Ketua II',
                'telepon' => '0816-7890-1234',
                'email' => 'wakilketua2@ptmsisumbar.or.id',
                'periode_mulai' => '2023-01-01',
                'periode_selesai' => '2027-12-31',
                'status' => 'aktif',
            ],
            [
                'id_organisasi' => 1,
                'nama' => 'Fitri Handayani, S.Sos.',
                'jabatan' => 'Ketua Bidang Pembinaan',
                'telepon' => '0817-8901-2345',
                'email' => 'pembinaan@ptmsisumbar.or.id',
                'periode_mulai' => '2023-01-01',
                'periode_selesai' => '2027-12-31',
                'status' => 'aktif',
            ],
            [
                'id_organisasi' => 1,
                'nama' => 'Gunawan Setiawan, S.E.',
                'jabatan' => 'Ketua Bidang Organisasi',
                'telepon' => '0818-9012-3456',
                'email' => 'organisasi@ptmsisumbar.or.id',
                'periode_mulai' => '2023-01-01',
                'periode_selesai' => '2027-12-31',
                'status' => 'aktif',
            ],
            [
                'id_organisasi' => 1,
                'nama' => 'Hendra Kurniawan, S.Kom.',
                'jabatan' => 'Ketua Bidang Humas',
                'telepon' => '0819-0123-4567',
                'email' => 'humas@ptmsisumbar.or.id',
                'periode_mulai' => '2023-01-01',
                'periode_selesai' => '2027-12-31',
                'status' => 'aktif',
            ],
        ];

        // Insert data
        $this->db->table('pengurus')->insertBatch($data);
    }
}
