<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogAktifitasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_log' => [
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
            'aksi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'jenis_entitas' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'id_entitas' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'dibuat_pada' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id_log', true); // primary key
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('log_aktifitas');
    }

    public function down()
    {
        $this->forge->dropTable('log_aktifitas');
    }
}
