<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EnhancePelatihAndOfisialTables extends Migration
{
    public function up()
    {
        // Add missing fields to pelatih table
        $this->forge->addColumn('pelatih', [
            'tanggal_lahir' => [
                'type'       => 'DATE',
                'null'       => true,
                'after'      => 'id_klub',
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
                'after'      => 'tanggal_lahir',
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'jenis_kelamin',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'alamat',
            ],
            'spesialisasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'no_hp',
            ],
            'dibuat_pada' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'tanggal_sertifikasi',
            ],
        ]);

        // Add missing fields to ofisial table
        $this->forge->addColumn('ofisial', [
            'tanggal_lahir' => [
                'type'       => 'DATE',
                'null'       => true,
                'after'      => 'id_user',
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
                'after'      => 'tanggal_lahir',
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'jenis_kelamin',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'alamat',
            ],
            'jenis_ofisial' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'no_hp',
            ],
            'dibuat_pada' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'status',
            ],
        ]);
    }

    public function down()
    {
        // Drop columns from pelatih table
        $this->forge->dropColumn('pelatih', [
            'tanggal_lahir',
            'jenis_kelamin',
            'alamat',
            'no_hp',
            'spesialisasi',
            'dibuat_pada',
        ]);

        // Drop columns from ofisial table
        $this->forge->dropColumn('ofisial', [
            'tanggal_lahir',
            'jenis_kelamin',
            'alamat',
            'no_hp',
            'jenis_ofisial',
            'dibuat_pada',
        ]);
    }
}
