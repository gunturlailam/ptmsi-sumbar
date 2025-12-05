<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelatihTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelatih' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'id_klub' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'tingkat_sertifikasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'tanggal_sertifikasi' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_pelatih', true); // primary key
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_klub', 'klub', 'id_klub', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pelatih');
    }

    public function down()
    {
        $this->forge->dropTable('pelatih');
    }
}
