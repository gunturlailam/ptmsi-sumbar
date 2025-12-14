<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateTestKlubUserSeeder extends Seeder
{
    public function run()
    {
        // Update test-klub-001 user to have correct peran
        $this->db->table('user')
            ->where('id_user', 'test-klub-001')
            ->update(['peran' => 'klub']);

        echo "Updated test-klub-001 user peran to 'klub'\n";
    }
}
