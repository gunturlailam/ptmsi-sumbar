<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePendaftaranEventTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pendaftaran' => [
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
            'tipe_pendaftar' => [
                'type'       => 'ENUM',
                'constraint' => ['klub', 'atlet'],
                'null'       => false,
            ],
            'id_klub' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_atlet' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'tanggal_daftar' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'status_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'id_verifikator' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_pendaftaran', true); // primary key
        $this->forge->addForeignKey('id_event', 'event', 'id_event', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_klub', 'klub', 'id_klub', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_atlet', 'atlet', 'id_atlet', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_verifikator', 'user', 'id_user', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pendaftaran_event');
    }

    public function down()
    {
        $this->forge->dropTable('pendaftaran_event');
    }
}
