<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CleanTestDataSeeder extends Seeder
{
    public function run()
    {
        // Clean test data
        $this->db->table('pendaftaran_atlet')
            ->where('email', 'testseeder@example.com')
            ->delete();

        echo "Cleaned test data from pendaftaran_atlet\n";
    }
}
