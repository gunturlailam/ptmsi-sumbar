<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_notifikasi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'tipe' => [
                'type' => 'ENUM',
                'constraint' => ['event', 'pertandingan', 'hasil', 'ranking', 'sistem'],
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'pesan' => [
                'type' => 'TEXT',
            ],
            'id_referensi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'tipe_referensi' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'comment' => 'event, pertandingan, ranking, dll',
            ],
            'dibaca' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'dibaca_pada' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'dibuat_pada' => [
                'type' => 'DATETIME',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id_notifikasi', false, false, 'PRIMARY');
        $this->forge->addKey('id_user');
        $this->forge->addKey('tipe');
        $this->forge->addKey('dibuat_pada');
        $this->forge->createTable('notifikasi');
    }

    public function down()
    {
        $this->forge->dropTable('notifikasi');
    }
}
