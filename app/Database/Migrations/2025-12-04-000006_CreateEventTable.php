<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEventTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_event' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            'id_turnamen' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_klub_penyelenggara' => [
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
                'null'       => false,
            ],
            'lokasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'batas_pendaftaran' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_event', true); // primary key
        $this->forge->addForeignKey('id_turnamen', 'turnamen', 'id_turnamen', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_klub_penyelenggara', 'klub', 'id_klub', 'CASCADE', 'CASCADE');
        $this->forge->createTable('event');
    }

    public function down()
    {
        $this->forge->dropTable('event');
    }
}
