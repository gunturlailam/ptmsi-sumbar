<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePesanKontakTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pesan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'subjek' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            'pesan' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'dibuat_pada' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_pesan', true); // primary key
        $this->forge->createTable('pesan_kontak');
    }

    public function down()
    {
        $this->forge->dropTable('pesan_kontak');
    }
}
