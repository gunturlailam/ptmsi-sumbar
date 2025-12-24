<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProvinsiEventSeeder extends Seeder
{
    public function run()
    {
        // Update ALL existing events to have free registration (biaya_pendaftaran = 0)
        $this->db->table('event')->update(['biaya_pendaftaran' => 0.00]);

        echo "All province-level events updated to be FREE (biaya_pendaftaran = 0.00)!\n";
    }
}
