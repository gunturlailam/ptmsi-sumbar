<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePertandinganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pertandingan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_event' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'babak' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'id_atlet1' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_atlet2' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'jadwal' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'venue' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_pertandingan', true); // primary key
        $this->forge->addForeignKey('id_event', 'event', 'id_event', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_atlet1', 'atlet', 'id_atlet', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_atlet2', 'atlet', 'id_atlet', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pertandingan');
    }

    public function down()
    {
        $this->forge->dropTable('pertandingan');
    }
}
