<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMediaBeritaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_media' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_berita' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'jenis' => [
                'type'       => 'ENUM',
                'constraint' => ['gambar', 'video'],
                'null'       => false,
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id_media', true); // primary key
        $this->forge->addForeignKey('id_berita', 'berita', 'id_berita', 'CASCADE', 'CASCADE');
        $this->forge->createTable('media_berita');
    }

    public function down()
    {
        $this->forge->dropTable('media_berita');
    }
}
