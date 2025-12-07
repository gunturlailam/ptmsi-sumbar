<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run()
    {
        echo "Starting Master Seeder...\n\n";

        // 1. User table
        echo "1. Seeding users...\n";
        $userData = [
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440001',
                'peran' => 'admin',
                'username' => 'admin',
                'email' => 'admin@ptmsisumbar.or.id',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Administrator PTMSI',
                'nohp' => '081234567890',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440002',
                'peran' => 'atlet',
                'username' => 'ahmad_fauzi',
                'email' => 'ahmad.fauzi@email.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Ahmad Fauzi',
                'nohp' => '081298765432',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440003',
                'peran' => 'atlet',
                'username' => 'siti_rahma',
                'email' => 'siti.rahma@email.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Siti Rahma',
                'nohp' => '081356789012',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440004',
                'peran' => 'atlet',
                'username' => 'budi_santoso',
                'email' => 'budi.santoso@email.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Budi Santoso',
                'nohp' => '081445678901',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440005',
                'peran' => 'atlet',
                'username' => 'dewi_lestari',
                'email' => 'dewi.lestari@email.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Dewi Lestari',
                'nohp' => '081523456789',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440006',
                'peran' => 'pelatih',
                'username' => 'andi_wijaya',
                'email' => 'andi.wijaya@email.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Andi Wijaya',
                'nohp' => '081612345678',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440007',
                'peran' => 'pelatih',
                'username' => 'rina_susanti',
                'email' => 'rina.susanti@email.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Rina Susanti',
                'nohp' => '081723456789',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440008',
                'peran' => 'atlet',
                'username' => 'riko_pratama',
                'email' => 'riko.pratama@email.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Riko Pratama',
                'nohp' => '081834567890',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440009',
                'peran' => 'atlet',
                'username' => 'maya_sari',
                'email' => 'maya.sari@email.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Maya Sari',
                'nohp' => '081945678901',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440010',
                'peran' => 'atlet',
                'username' => 'doni_saputra',
                'email' => 'doni.saputra@email.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Doni Saputra',
                'nohp' => '082012345678',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('user')->insertBatch($userData);
        echo "   ✓ Users seeded successfully!\n\n";

        // 2. Organisasi table
        echo "2. Seeding organisasi...\n";
        $organisasiData = [
            [
                'nama_organisasi' => 'PTMSI Sumatera Barat',
                'jenis' => 'provinsi',
                'id_induk_organisasi' => null,
                'alamat' => 'Jl. Khatib Sulaiman No. 52, Padang',
                'nohp' => '0751123456',
            ],
            [
                'nama_organisasi' => 'PTMSI Kota Padang',
                'jenis' => 'kabupaten',
                'id_induk_organisasi' => 1,
                'alamat' => 'Jl. Sudirman No. 10, Padang',
                'nohp' => '0751234567',
            ],
            [
                'nama_organisasi' => 'PTMSI Kota Bukittinggi',
                'jenis' => 'kabupaten',
                'id_induk_organisasi' => 1,
                'alamat' => 'Jl. Ahmad Yani No. 5, Bukittinggi',
                'nohp' => '0752345678',
            ],
        ];
        $this->db->table('organisasi')->insertBatch($organisasiData);
        echo "   ✓ Organisasi seeded successfully!\n\n";

        // 3. Klub table
        echo "3. Seeding klub...\n";
        $klubData = [
            [
                'id_organisasi' => 2,
                'nama' => 'PB Padang Jaya',
                'alamat' => 'Jl. Veteran No. 15, Padang',
                'penanggung_jawab' => 'Budi Hartono',
                'telepon' => '081234567890',
                'tanggal_berdiri' => '2010-05-15',
                'status' => 'aktif',
            ],
            [
                'id_organisasi' => 2,
                'nama' => 'PB Minang Raya',
                'alamat' => 'Jl. Pemuda No. 20, Padang',
                'penanggung_jawab' => 'Siti Aminah',
                'telepon' => '081298765432',
                'tanggal_berdiri' => '2012-08-20',
                'status' => 'aktif',
            ],
            [
                'id_organisasi' => 3,
                'nama' => 'PB Bukittinggi United',
                'alamat' => 'Jl. Soekarno Hatta No. 8, Bukittinggi',
                'penanggung_jawab' => 'Ahmad Yani',
                'telepon' => '081356789012',
                'tanggal_berdiri' => '2015-03-10',
                'status' => 'aktif',
            ],
        ];
        $this->db->table('klub')->insertBatch($klubData);
        echo "   ✓ Klub seeded successfully!\n\n";

        // 4. Atlet table
        echo "4. Seeding atlet...\n";
        $atletData = [
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440002',
                'id_klub' => 1,
                'tanggal_lahir' => '2008-05-15',
                'jenis_kelamin' => 'L',
                'kategori_usia' => 'U-18',
                'ranking_provinsi' => 1,
                'status' => 'aktif',
                'dibuat_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440003',
                'id_klub' => 1,
                'tanggal_lahir' => '2009-08-20',
                'jenis_kelamin' => 'P',
                'kategori_usia' => 'U-15',
                'ranking_provinsi' => 2,
                'status' => 'aktif',
                'dibuat_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440004',
                'id_klub' => 2,
                'tanggal_lahir' => '2007-03-10',
                'jenis_kelamin' => 'L',
                'kategori_usia' => 'U-18',
                'ranking_provinsi' => 3,
                'status' => 'aktif',
                'dibuat_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440005',
                'id_klub' => 2,
                'tanggal_lahir' => '2010-11-25',
                'jenis_kelamin' => 'P',
                'kategori_usia' => 'U-15',
                'ranking_provinsi' => 1,
                'status' => 'aktif',
                'dibuat_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440008',
                'id_klub' => 3,
                'tanggal_lahir' => '2006-07-18',
                'jenis_kelamin' => 'L',
                'kategori_usia' => 'Senior',
                'ranking_provinsi' => 5,
                'status' => 'aktif',
                'dibuat_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440009',
                'id_klub' => 3,
                'tanggal_lahir' => '2011-02-14',
                'jenis_kelamin' => 'P',
                'kategori_usia' => 'U-12',
                'ranking_provinsi' => 4,
                'status' => 'aktif',
                'dibuat_pada' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440010',
                'id_klub' => 1,
                'tanggal_lahir' => '2008-09-30',
                'jenis_kelamin' => 'L',
                'kategori_usia' => 'U-18',
                'ranking_provinsi' => 2,
                'status' => 'aktif',
                'dibuat_pada' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('atlet')->insertBatch($atletData);
        echo "   ✓ Atlet seeded successfully!\n\n";

        // 5. Pelatih table
        echo "5. Seeding pelatih...\n";
        $pelatihData = [
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440006',
                'id_klub' => 1,
                'tingkat_sertifikasi' => 'Pelatih Level A',
                'tanggal_sertifikasi' => '2020-06-15',
            ],
            [
                'id_user' => '550e8400-e29b-41d4-a716-446655440007',
                'id_klub' => 2,
                'tingkat_sertifikasi' => 'Pelatih Level B',
                'tanggal_sertifikasi' => '2021-08-20',
            ],
        ];
        $this->db->table('pelatih')->insertBatch($pelatihData);
        echo "   ✓ Pelatih seeded successfully!\n\n";

        // 6. Turnamen table
        echo "6. Seeding turnamen...\n";
        $turnamenData = [
            [
                'nama' => 'Kejuaraan Provinsi Sumbar 2025',
                'tingkat' => 'provinsi',
                'tahun_musim' => 2025,
            ],
            [
                'nama' => 'Open Tournament Padang 2025',
                'tingkat' => 'open',
                'tahun_musim' => 2025,
            ],
            [
                'nama' => 'Kejuaraan Nasional Junior 2025',
                'tingkat' => 'nasional',
                'tahun_musim' => 2025,
            ],
        ];
        $this->db->table('turnamen')->insertBatch($turnamenData);
        echo "   ✓ Turnamen seeded successfully!\n\n";

        // 7. Event table
        echo "7. Seeding event...\n";
        $eventData = [
            [
                'judul' => 'Kejuaraan Provinsi Sumbar 2025 - Kategori U-18',
                'id_turnamen' => 1,
                'id_klub_penyelenggara' => 1,
                'tanggal_mulai' => '2025-11-15',
                'tanggal_selesai' => '2025-11-20',
                'lokasi' => 'GOR Haji Agus Salim, Padang',
                'batas_pendaftaran' => '2025-11-01',
                'status' => 'dibuka',
            ],
            [
                'judul' => 'Open Tournament Padang 2025 - Senior',
                'id_turnamen' => 2,
                'id_klub_penyelenggara' => 2,
                'tanggal_mulai' => '2025-10-10',
                'tanggal_selesai' => '2025-10-15',
                'lokasi' => 'GOR Universitas Negeri Padang',
                'batas_pendaftaran' => '2025-09-30',
                'status' => 'selesai',
            ],
        ];
        $this->db->table('event')->insertBatch($eventData);
        echo "   ✓ Event seeded successfully!\n\n";

        echo "Master Seeder completed successfully!\n";
        echo "========================================\n";
        echo "Summary:\n";
        echo "- 10 Users created\n";
        echo "- 3 Organisasi created\n";
        echo "- 3 Klub created\n";
        echo "- 7 Atlet created\n";
        echo "- 2 Pelatih created\n";
        echo "- 3 Turnamen created\n";
        echo "- 2 Event created\n";
        echo "========================================\n";
    }
}
