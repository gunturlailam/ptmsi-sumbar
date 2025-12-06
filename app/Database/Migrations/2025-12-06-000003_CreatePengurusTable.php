<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengurusTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengurus' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_organisasi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'periode_mulai' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'periode_selesai' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'aktif',
            ],
        ]);

        $this->forge->addKey('id_pengurus', true); // primary key
        $this->forge->addForeignKey('id_organisasi', 'organisasi', 'id_organisasi', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pengurus');
    }

    public function down()
    {
        $this->forge->dropTable('pengurus');
    }
}
