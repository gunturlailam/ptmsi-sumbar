<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelatihAtletTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelatih_atlet' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pelatih' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_atlet' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'tanggal_mulai' => [
                'type'       => 'DATE',
                'null'       => false,
            ],
            'tanggal_selesai' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'selesai', 'berhenti'],
                'default'    => 'aktif',
                'null'       => false,
            ],
            'catatan' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id_pelatih_atlet', true);
        $this->forge->addForeignKey('id_pelatih', 'pelatih', 'id_pelatih', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_atlet', 'atlet', 'id_atlet', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pelatih_atlet');
    }

    public function down()
    {
        $this->forge->dropTable('pelatih_atlet');
    }
}
