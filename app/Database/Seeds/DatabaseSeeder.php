<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        echo "========================================\n";
        echo "Running All Seeders...\n";
        echo "========================================\n\n";

        // 1. Master Seeder (MUST RUN FIRST)
        echo "Step 1/6: Running MasterSeeder...\n";
        $this->call('MasterSeeder');
        echo "\n";

        // 2. Ranking Seeder
        echo "Step 2/6: Running RankingSeeder...\n";
        $this->call('RankingSeeder');
        echo "\n";

        // 3. Berita Seeder
        echo "Step 3/6: Running BeritaSeeder...\n";
        $this->call('BeritaSeeder');
        echo "\n";

        // 4. Dokumen Seeder
        echo "Step 4/6: Running DokumenSeeder...\n";
        $this->call('DokumenSeeder');
        echo "\n";

        // 5. Galeri Seeder
        echo "Step 5/6: Running GaleriSeeder...\n";
        $this->call('GaleriSeeder');
        echo "\n";

        // 6. Layanan Online Seeder
        echo "Step 6/6: Running LayananOnlineSeeder...\n";
        $this->call('LayananOnlineSeeder');
        echo "\n";

        echo "========================================\n";
        echo "All Seeders Completed Successfully!\n";
        echo "========================================\n";
        echo "\nLogin Credentials:\n";
        echo "Admin - Username: admin, Password: admin123\n";
        echo "Atlet - Username: ahmad_fauzi, Password: password123\n";
        echo "========================================\n";
    }
}
